<?php


if (!function_exists('karyawan'))
{
	function karyawan($id,$col="")// $id : iduser/nohp/email
	{
		$karyawanAktif	  ="SELECT 		dk.*,dkp.* 
							FROM 		data_karyawan dk 
							LEFT JOIN 	data_karyawan_pribadi dkp
							ON 			dk.iduser	= dkp.iduser
							WHERE 		dk.iduser	= '".escStringDB($id)."' OR
										dk.nohp1 	= '".escStringDB($id)."' OR
										dk.email1	= '".escStringDB($id)."'";

		$karyawanHistory  ="SELECT 		dk.*,dkp.* 
							FROM 		data_karyawan_history dk 
							LEFT JOIN 	data_karyawan_pribadi dkp
							ON 			dk.iduser	= dkp.iduser
							WHERE 		dk.iduser	= '".escStringDB($id)."' OR
										dk.nohp1 	= '".escStringDB($id)."' OR
										dk.email1	= '".escStringDB($id)."'";

		$karyawan=cekData($karyawanAktif)>0?getData($karyawanAktif):getData($karyawanHistory);
		return ($col!="" && isset($karyawan[$col]))?$karyawan[$col]:$karyawan;
	}
}


if (!function_exists('cekLogin'))
{
	function cekLogin($username,$password)
	{	
        $username=escStringDB($username);
        $password=md7($password);
		$qry="  SELECT * FROM data_karyawan 
                WHERE   ( 
                            email1='".$username."' OR 
                            email2='".$username."' OR 
                            nohp1 ='".$username."' OR 
                            nohp2 ='".$username."'
                        ) 
                        AND pswd='".$password."'";
		return cekdata($qry);
	}
}


if (!function_exists('SettingUser'))
{
	function SettingUser($keyword="blank",$content="blank-content")
	{
		$qry=mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM sys_setting_user WHERE keyword='".escStringDB($keyword)."' AND uid='".$_SESSION["sess"]["iduser"]."'");
		if(mysqli_num_rows($qry)==0)
		{
			if($content=="blank-content") $content=SettingUser_DefaultContent($keyword);			
			mysqli_query($_SESSION["sess"]["koneksi"],"INSERT INTO sys_setting_user (uid,keyword,content) VALUES ('".$_SESSION["sess"]["iduser"]."','".escStringDB($keyword)."','".escStringDB($content)."')");
		}
		elseif($content!="blank-content")
		{
			mysqli_query($_SESSION["sess"]["koneksi"],"UPDATE sys_setting_user SET content='".escStringDB($content)."' WHERE keyword='".escStringDB($keyword)."' AND uid='".$_SESSION["sess"]["iduser"]."'");
		}		
		
		$data = mysqli_fetch_assoc(mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM sys_setting_user WHERE keyword='".escStringDB($keyword)."' AND uid='".$_SESSION["sess"]["iduser"]."'"));
		return $data["content"];
	}
}


if (!function_exists('SettingApp'))
{
	function SettingApp($data=array())
	{
		$data["idobject"] = $data["idobject"] ?? "";
		$data["keyword"]  = $data["keyword"]  ?? "blank-keyword";
		$data["content"]  = $data["content"]  ?? "blank-content";
		$data["content"]  = is_array($data["content"])?json_encode($data["content"]):$data["content"];

		$qry=mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM sys_setting_app WHERE keyword='".escStringDB($data["keyword"])."' AND idobject='".escStringDB($data["idobject"])."'");
		if(mysqli_num_rows($qry)==0)
		{
			if($data["content"]=="blank-content") $data["content"]="";
			mysqli_query($_SESSION["sess"]["koneksi"],"INSERT INTO sys_setting_app (keyword,content,idobject) VALUES ('".escStringDB($data["keyword"])."','".escStringDB($data["content"])."','".escStringDB($data["idobject"])."')");
		}
		elseif($data["content"]!="blank-content")
		{
			mysqli_query($_SESSION["sess"]["koneksi"],"UPDATE sys_setting_app SET content='".escStringDB($data["content"])."' WHERE keyword='".escStringDB($data["keyword"])."' AND idobject='".escStringDB($data["idobject"])."'");
		}		
		
		$data = mysqli_fetch_array(mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM sys_setting_app WHERE keyword='".escStringDB($data["keyword"])."' AND idobject='".escStringDB($data["idobject"])."'"));
		return $data["content"]??"";

		# CARA GET DATA content
		# SettingApp(array("keyword"=>"dataDefaultSpr_NamaBankRekeningTransfer","idobject"=>$idperusahaan));
		# CARA SET DATA content
		# SettingApp(array("keyword"=>"dataDefaultSpr_NamaBankRekeningTransfer","idobject"=>$idperusahaan,"content"=>$content));
	}
}


if (!function_exists('SettingUser_DefaultContent'))
{
	function SettingUser_DefaultContent($keyword)
	{
		if($keyword=="userdata-filter-status") 				$content="1";
		elseif($keyword=="userdata-sort-role") 				$content="top-bottom";
		elseif($keyword=="userdata-sort-name") 				$content="a-z";
		elseif($keyword=="userdata-dataperpage")			$content="25";
		elseif($keyword=="userdata-kolom-role")				$content="1";
		elseif($keyword=="userdata-kolom-phone")			$content="1";
		elseif($keyword=="bookingKavling_BlinkingOutline")	$content="1";
		elseif($keyword=="bookingKavling_SiteplanColoring")	$content="1";
		elseif($keyword=="pagingDataPenjualan")				$content=25;
		elseif($keyword=="templateKolomDataPenjualan")		$content='{"SelectedTemplate":"Default"}';
		else $content="";
		
		return $content;
	}
}


if (!function_exists('iconFileFontAwesome'))
{
	function iconFileFontAwesome($namafile="")
	{
		$n = explode(".",$namafile);
		$n = $n[count($n)-1];

		if(		$n=="dir") 	$i = '<span class="text-warning"><i class="fas fa-folder"></i></span>';
		elseif( $n=="csv")	$i = '<span class="text-success"><i class="fas fa-file-csv"></i></span>';
		elseif(	$n=="xls") 	$i = '<span class="text-success"><i class="fas fa-file-excel"></i></span>';
		elseif( $n=="xlsx")	$i = '<span class="text-success"><i class="fas fa-file-excel"></i></span>';
		elseif( $n=="doc")	$i = '<span class="text-primary"><i class="fas fa-file-word"></i></span>';
		elseif( $n=="docx")	$i = '<span class="text-primary"><i class="fas fa-file-word"></i></span>';
		elseif( $n=="ppt")	$i = '<span class="text-danger"><i class="fas fa-file-powerpoint"></i></span>';
		elseif( $n=="pptx")	$i = '<span class="text-danger"><i class="fas fa-file-powerpoint"></i></span>';
		elseif( $n=="pdf")	$i = '<span class="text-danger"><i class="fas fa-file-pdf"></i></span>';
		elseif( $n=="zip")	$i = '<span class="text-secondary"><i class="fas fa-file-archive"></i></span>';
		elseif( $n=="zipx")	$i = '<span class="text-secondary"><i class="fas fa-file-archive"></i></span>';
		elseif( $n=="rar")	$i = '<span class="text-secondary"><i class="fas fa-file-archive"></i></span>';
		elseif( $n=="rarx")	$i = '<span class="text-secondary"><i class="fas fa-file-archive"></i></span>';
		elseif( $n=="jpg")	$i = '<span class="text-primary"><i class="fas fa-image"></i></span>';
		elseif( $n=="jpeg")	$i = '<span class="text-primary"><i class="fas fa-image"></i></span>';
		elseif( $n=="png")	$i = '<span class="text-success"><i class="fas fa-image"></i></span>';
		elseif( $n=="bmp")	$i = '<span class="text-danger"><i class="fas fa-image"></i></span>';
		elseif( $n=="gif")	$i = '<span class="text-danger"><i class="fas fa-image"></i></span>';
		elseif( $n=="mp4")	$i = '<span class="text-primary"><i class="fas fa-video"></i></span>';
		else				$i = '<span class="text-secondary"><i class="fas fa-file"></i></span>';

		return $i;
	}
}


if (!function_exists('fileExt'))
{
	function fileExt($namafile="")
	{
		$namafile=trim($namafile);

		if($namafile=="") $ext="";
		else
		{
			$namafile = explode(".",$namafile);
			$ext = $namafile[count($namafile)-1];
		}

		return $ext;
	}
}


if (!function_exists('fileNameUrl'))
{
	function fileNameUrl($namafile="")
	{
		$fileExt	 = fileExt($namafile);
		$fileName	 = UrlText(str_replace(".".$fileExt,"",$namafile));
		$fileNameUrl = $fileName.".".$fileExt;

		return $fileNameUrl;
	}
}