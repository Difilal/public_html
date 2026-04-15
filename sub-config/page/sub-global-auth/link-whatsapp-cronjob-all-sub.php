<?php //exit;

if(	$_SERVER['HTTP_HOST']=="adms.pmpland.co.id:1111" || 
	$_SERVER['HTTP_HOST']=="worker-wa-sync.pmpland.co.id:1111" || 
	$_SERVER['HTTP_HOST']=="config-tams.irwan.id")
{
	

	include("tag/link-mysql-hosting-server.php");

	// if(isset($_POST["idwa"])) 	$idwa = $_POST["idwa"];
	// if(isset($_GET["idwa"])) 	$idwa = $_GET["idwa"];
	// $nohp_wa	= getData("data_nohp_wa","idwa='".$idwa."'");
	/* $sekolah	= getData("data_sekolah","idsekolah='".$nohp_wa["idsekolah"]."'");
	$angkatan	= getData("data_angkatan","idangkatan='".$nohp_wa["idangkatan"]."'"); */
	// $report[$idwa]["page"]="";


	//$dataLogWA	= getData("data_log_wa","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND nohp_tujuan!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 10","all");
	$dataLogWA	= getData("data_log_wa","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND nohp_pengirim IN (SELECT nohp_wa FROM data_nohp_wa WHERE idwa='".$idwa."') AND nohp_tujuan!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 10","all");

	foreach($dataLogWA["data"] AS $key=>$val)
	{

		// $LogWA		= getData("data_log_wa","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND nohp_tujuan!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 1");
		// $cekLogWA	= cekData("data_log_wa","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND nohp_tujuan!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 1");
		
		$nohp_wa	= getData("data_nohp_wa","idwa='".$idwa."'");
		$LogWA		= $val;
		$cekLogWA	= $dataLogWA["count"];
		
		if($cekLogWA>0 && !isset($browserjob))
		{
			$report[$idwa]["idlogwa"]			= $LogWA["idlogwa"];
			$report[$idwa]["nohp_tujuan"]		= $LogWA["nohp_tujuan"];
			$report[$idwa]["nohp_tujuan_md5"]	= md5($LogWA["nohp_tujuan"]);
			$report[$idwa]["pesan"]				= nl2br($LogWA["pesan"]);
			$report[$idwa]["pesan_md5"]			= md5(nl2br($LogWA["pesan"]));
			$report[$idwa]["waktu"]				= $LogWA["waktu"];
			$report[$idwa]["waktu_md5"]			= md5($LogWA["waktu"]);
			$report[$idwa]["status_kirim"]		= $LogWA["status_kirim"];
			
			
			$siteURL	= $_SESSION["sess"]["app_siteURL"]; # $siteURL=siteURL();
			$nama_file  = str_replace("file-upload/",	$siteURL."image-upload/",$LogWA["nama_file"]);
			$nama_file  = str_replace("file-konsumen/",	$siteURL."file-konsumen/",$nama_file);
			//$nama_file  = str_replace("/","\\",rootDir().$LogWA["nama_file"]);
			if($LogWA["nama_file"]!="")	$sendType="text+image";
			else						$sendType="text";
			
			$dataApiWa["phone_src"]      = $nohp_wa["api_key"];
			$dataApiWa["phone_dst"]      = $LogWA["nohp_tujuan"];
			$dataApiWa["message"]        = $LogWA["pesan"];
			$dataApiWa["waktu_kirim"]    = $LogWA["waktu"];
			$dataApiWa["nama_file"]      = $nama_file;
			$dataApiWa["sendType"]       = $sendType;
			
			$report[$idwa]["result"]=$result=apiWhatsapp($dataApiWa); // $report[$idwa]["result"]=$result=apiWhatsapp($nohp_wa["api_key"],$phone_no,$message,$nama_file,$sendType);
			$report[$idwa]["result_md5"]=md5($report[$idwa]["result"]);

			$report[$idwa]["resultxxx"]=$result." : ".$nama_file;

			if(strtolower($result)=="success" || strtolower($result)=="false" || $result==false || $result==1 || $result=="1")
			{
				$lama_waktu_terkirim=strtotime(date("Y-m-d H:i:s"))-strtotime($LogWA["waktu"]);
				runQuery("UPDATE data_log_wa SET status_kirim='sent', waktu_terkirim='".date("Y-m-d H:i:s")."', lama_waktu_terkirim='".$lama_waktu_terkirim."' WHERE idlogwa='".$LogWA["idlogwa"]."' LIMIT 1");
			}
			else if(strtolower(substr($result,-16))=="number not found")
			{
				runQuery("UPDATE data_log_wa 		SET status_kirim='invalid_number' 	WHERE idlogwa='".$LogWA["idlogwa"]."'"); 
				setStatusNoHP($LogWA["nohp_tujuan"],"nonaktif");
			} 
			else if(strtolower(substr($result,-14))=="invalid_number"){ } 
			else
			{
				
				runQuery("UPDATE data_log_wa SET keterangan=CONCAT( keterangan, ', ".$result."') WHERE idlogwa='".$LogWA["idlogwa"]."' LIMIT 1");
			}
			
				
			if(substr($LogWA["send_group"],0,3)=="bcg")
			{
				/* $cekBcgTotal	= cekdata("data_log_wa","send_group='".$LogWA["send_group"]."'");
				$cekBcgTerkirim = cekdata("data_log_wa","send_group='".$LogWA["send_group"]."' AND status_kirim='sent'"); */
				/* if($cekBcgTotal==$cekBcgTerkirim) runQuery("UPDATE data_broadcast_general SET status='sent' WHERE send_group='".$LogWA["send_group"]."'"); */
				
				$cekBcgQueue 	= cekdata("data_log_wa","send_group='".$LogWA["send_group"]."' AND (status_kirim='queue' OR status_kirim='pending')");
				if($cekBcgQueue==0) runQuery("UPDATE data_broadcast_general SET status='sent' WHERE send_group='".$LogWA["send_group"]."'");
			}
		}

	}







	//if(isset($_POST["idwa"]) && isset($report)) echo json_encode($report);	


}