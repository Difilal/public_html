<?php

function UploadMultiImgJPG($ImageFile,$MaxWidth,$MaxHeight,$CopyQuality,$NewFileNameDotJpg,$UploadDir)
{	
			$resize			= 0;
			$error			= '';
				
			list($SrcWidth, $SrcHeight, $type, $attr) = getimagesize($ImageFile);
			//$fileName 	= $ImageFile['name']; 		
			//$fileSize 	= $ImageFile['size'];	
			$tmpName  		= $ImageFile;
			
			if(image_type($type)!="JPG"){ $error=1; $infotxt="File harus dalam format JPG"; }
			
			if($error!=1)
			{				
				if(substr($UploadDir,-1)!="/") $UploadDir.="/";
				if(!file_exists($UploadDir.'index.html')) fopen($UploadDir.'index.html', "w");
				$NewFileNameDotJpg 		= $UploadDir.$NewFileNameDotJpg;
				$NewFileNameDotJpgTmp 	= $UploadDir."_tmp-pp-".rand(198273,987385).".jpg";
				if($SrcWidth>$SrcHeight){ 		if($SrcWidth>$MaxWidth){ 	$resize=1; $PoinResize="width"; }}
				elseif($SrcHeight>$SrcWidth){ 	if($SrcHeight>$MaxHeight){	$resize=1; $PoinResize="height"; }}
				else{							if($SrcHeight>$MaxWidth){ 	$resize=1; $PoinResize="height"; }}
				
				if($resize==1)
				{
					if($PoinResize=="width"){ 		$PersenResize = ($MaxWidth*100)/$SrcWidth; }
					elseif($PoinResize=="height"){ 	$PersenResize = ($MaxHeight*100)/$SrcHeight; }
					
					$DstWidth  = floor(($PersenResize*$SrcWidth)/100);
					$DstHeight = floor(($PersenResize*$SrcHeight)/100);
					
					//Simpan gambar dalam ukuran sebenarnya
					move_uploaded_file($tmpName,$NewFileNameDotJpgTmp);
					
					//identitas file asli
					$im_src=imagecreatefromjpeg($NewFileNameDotJpgTmp);
					
					//proses perubahan ukuran
					$im = imagecreatetruecolor($DstWidth,$DstHeight);
					imagecopyresampled($im, $im_src, 0, 0, 0, 0, $DstWidth, $DstHeight, $SrcWidth, $SrcHeight);
					
					//Simpan gambar
					imagejpeg($im,$NewFileNameDotJpg,$CopyQuality);
					
					//Hapus gambar di memori komputer
					imagedestroy($im_src);
					imagedestroy($im);
					
					//Hapus gambar dalam ukuran sebenarnya
					unlink($NewFileNameDotJpgTmp);
					
					$infotxt="success";
				}
				else{ move_uploaded_file ($tmpName,$NewFileNameDotJpg); $infotxt="success"; }
			}else $infotxt="failed";
			return $infotxt;
}

function thumbnail($vdir_upload,$fupload_name,$dst_width) //-> Not Used
{
	$_SESSION["sess"]["ExecFunction"]='thumbnail';
	$_SESSION["sess"]["ThumbName"]=$PolaNama	= $dst_width."-".$fupload_name;
	//$NamaThumb  = $vdir_upload.$PolaNama;
	if(!file_exists("thumb/")) mkdir("thumb/");
	if(!file_exists('thumb/index.html')) fopen('thumb/index.html', "w");
	$NamaThumb  = "thumb/".$PolaNama;
	if(file_exists($vdir_upload.$fupload_name) && !file_exists($NamaThumb))
	{
		//identitas file asli
		$im_src 	= imagecreatefromjpeg($vdir_upload.$fupload_name);
		$src_width 	= imageSX($im_src);
		$src_height = imageSY($im_src);
		$resize		= '';
		
		if($src_width>$src_height){ 	if($src_width>$dst_width){ 	$resize=1; $PoinResize="width"; }}
		elseif($src_height>$src_width){ if($src_height>$dst_width){	$resize=1; $PoinResize="height"; }}
		else{							if($src_height>$dst_width){ $resize=1; $PoinResize="height"; }}
		
		if($resize==1){
			if($PoinResize=="width"){ 		$PersenResize = ($dst_width*100)/$src_width; } // Cth.Hasil "50" utk 50%
			elseif($PoinResize=="height"){ 	$PersenResize = ($dst_width*100)/$src_height; }
			
			$dst_width  = floor(($PersenResize*$src_width)/100);
			$dst_height = floor(($PersenResize*$src_height)/100);
		}
		else{
			$dst_width = $dst_width;
			$dst_height = ($dst_width/$src_width)*$src_height;
		}
		
		//proses perubahan ukuran
		$im = imagecreatetruecolor($dst_width,$dst_height);
		imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		//Simpan gambar
		imagejpeg($im,$NamaThumb);
		
		//Hapus gambar di memori komputer
		imagedestroy($im_src);
		imagedestroy($im);
	}
	return $NamaThumb;
}

function ThumbSquare($DirFileLocation,$FileName,$ThumbWidth,$DirThumbToSave="thumb/",$BgColor="white")/* $BgColor(black,white) NOT USEEEEEED ANYMORE */
{
	$dst_width = $ThumbWidth;
	$_SESSION["sess"]["ExecFunction"]='ThumbSquare';
	$_SESSION["sess"]["ThumbName"]=$PolaNama	= $dst_width."-".$FileName;
	//$NamaThumb  = $DirFileLocation.$PolaNama;
	if(!file_exists("userdata/")) mkdir("userdata/");
	if(!file_exists('userdata/index.html')) fopen('userdata/index.html', "w");
	if(!file_exists($DirThumbToSave)) mkdir($DirThumbToSave);
	if(!file_exists($DirThumbToSave.'index.html')) fopen($DirThumbToSave.'index.html', "w");
	$NamaThumb  = $DirThumbToSave.$PolaNama;
	//if(file_exists($DirFileLocation.$FileName) && !file_exists($NamaThumb))
	if(file_exists($DirFileLocation.$FileName))
	{
		//identitas file asli
		$im_src 	= imagecreatefromjpeg($DirFileLocation.$FileName);
		$src_width 	= imagesx($im_src);
		$src_height = imagesy($im_src);
		$resize		= '';
		
		if($src_width>$src_height){ 	if($src_width>$ThumbWidth){  $resize=1; $PoinResize="width"; }}
		elseif($src_height>$src_width){ if($src_height>$ThumbWidth){ $resize=1; $PoinResize="height"; }}
		else{							if($src_height>$ThumbWidth){ $resize=1; $PoinResize="height"; }}
		
		if($resize==1){
			if($PoinResize=="width"){ 		$PersenResize = ($ThumbWidth*100)/$src_width; } // Cth.Hasil "50" utk 50%
			elseif($PoinResize=="height"){ 	$PersenResize = ($ThumbWidth*100)/$src_height; }
			
			$dst_width  = floor(($PersenResize*$src_width)/100);
			$dst_height = floor(($PersenResize*$src_height)/100);
		}
		else{
			$dst_width = $ThumbWidth;
			$dst_height = ($ThumbWidth/$src_width)*$src_height;
		}
					
		if($src_width>$src_height){ 		$dst_x=0;$dst_y=(($ThumbWidth-$dst_height)-(($ThumbWidth-$dst_height)%2))/2; }
		elseif($src_width<$src_height){ 	$dst_y=0;$dst_x=(($ThumbWidth-$dst_width)-(($ThumbWidth-$dst_width)%2))/2; }
		else{								$dst_y=0;$dst_x=0; }
		
		//proses perubahan ukuran
		$im = imagecreatetruecolor($ThumbWidth,$ThumbWidth);
			#-> Rubah warna background jadi putih
			if($BgColor=="white"){
			$white = imagecolorallocate($im, 255, 255, 255);
			imagefill($im, 0, 0, $white); }
		imagecopyresampled($im, $im_src, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		//Simpan gambar
		imagejpeg($im,$NamaThumb,100);
		
		//Hapus gambar di memori komputer
		imagedestroy($im_src);
		imagedestroy($im);
	}
	if(file_exists($NamaThumb)) return str_replace("thumb/","thumb-".date("ymdhis")."--",$NamaThumb);
	//return $NamaThumb;
}

function Thumb43($DirFileLocation,$FileName,$ThumbWidth,$ThumbHeight,$BgColor="white",$DirThumbToSave="thumb/",$CopyQuality=90)/* $BgColor(NoBG,black,white) */
{
	$dst_width = $ThumbWidth;
	$_SESSION["sess"]["ExecFunction"]='Thumb43';
	$_SESSION["sess"]["ThumbName"]=$PolaNama = $ThumbWidth.'x'.$ThumbHeight."-bg".$BgColor."-".md7($DirFileLocation.$FileName)."-".str_replace(" ","-",$FileName);
	if(!file_exists($DirThumbToSave)) mkdir($DirThumbToSave);
	if(!file_exists($DirThumbToSave.'index.html')) fopen($DirThumbToSave.'index.html', "w");
	$NamaThumb  = $DirThumbToSave.$PolaNama;
	list($SrcWidth, $SrcHeight, $type, $attr) = getimagesize($DirFileLocation.$FileName);
	
	// logFile(image_type($type),null,"image_type");
	if(file_exists($DirFileLocation.$FileName) && (image_type($type)=="JPG") && !file_exists($NamaThumb))
	{
		//identitas file asli
		$im_src 	= imagecreatefromjpeg($DirFileLocation.$FileName);
		$src_width 	= imagesx($im_src);
		$src_height = imagesy($im_src);
		$resize		= '';
		
		$w4 = $src_width/$ThumbWidth;
		$h3 = $src_height/$ThumbHeight;
		
		if($w4>$h3)		{ $resize=1; $PoinResize="width"; }
		elseif($w4<=$h3){ $resize=1; $PoinResize="height"; }
		
		if($resize==1){
			#mendapatkan angka presentasi untuk mendapatkan ukuran width & height yg proporsional
			if($PoinResize=="width"){ 		$PersenResize = ($ThumbWidth*100)/$src_width; } // Cth.Hasil "50" utk 50%
			elseif($PoinResize=="height"){ 	$PersenResize = ($ThumbHeight*100)/$src_height; }
			
			$dst_width  = floor(($PersenResize*$src_width)/100);
			$dst_height = floor(($PersenResize*$src_height)/100);
		}
					
		if($dst_width<=$src_width || $dst_height<=$src_height){
			if($w4>$h3){ 		$dst_x=0;$dst_y=(($ThumbHeight-$dst_height)-(($ThumbHeight-$dst_height)%2))/2; }
			elseif($w4<$h3){ 	$dst_y=0;$dst_x=(($ThumbWidth-$dst_width)-(($ThumbWidth-$dst_width)%2))/2; }
			else{				$dst_y=0;$dst_x=0; }/**/
		}else{
			$dst_width=$src_width ;
			$dst_height=$src_height;
			$dst_y=(($ThumbHeight-$dst_height)-(($ThumbHeight-$dst_height)%2))/2; 
			$dst_x=(($ThumbWidth-$dst_width)-(($ThumbWidth-$dst_width)%2))/2; 
		}
		
		//proses perubahan ukuran
		/* $im = imagecreatetruecolor($ThumbWidth,$ThumbHeight);
			
			if($BgColor=="white"){ 		$FillBgColor = imagecolorallocate($im, 255, 255, 255); imagefill($im, 0, 0, $FillBgColor); }#-> Rubah warna background jadi putih
			elseif($BgColor=="black"){ 		$FillBgColor = imagecolorallocate($im, 0, 0, 0); imagefill($im, 0, 0, $FillBgColor); }
			elseif($BgColor=="red"){ 	$FillBgColor = imagecolorallocate($im, 255, 0, 0); imagefill($im, 0, 0, $FillBgColor); }
		imagecopyresampled($im, $im_src, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $src_width, $src_height); */
		
		if($BgColor=="NoBG") 	$im = imagecreatetruecolor($dst_width,$dst_height);
		else					$im = imagecreatetruecolor($ThumbWidth,$ThumbHeight);
		
		if($BgColor=="white"){ 		$FillBgColor = imagecolorallocate($im, 255, 255, 255); imagefill($im, 0, 0, $FillBgColor); }
		elseif($BgColor=="black"){ 	$FillBgColor = imagecolorallocate($im, 0, 0, 0); imagefill($im, 0, 0, $FillBgColor); }
		elseif($BgColor=="red"){ 	$FillBgColor = imagecolorallocate($im, 255, 0, 0); imagefill($im, 0, 0, $FillBgColor); }
		
		if($BgColor=="NoBG") imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		else 				 imagecopyresampled($im, $im_src, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		
		$im_src = imagejpeg($im,$NamaThumb,$CopyQuality);//Simpan gambar
		#imagedestroy($im_src);//Hapus gambar di memori komputer
		imagedestroy($im);
	}
	//return $NamaThumb;
	if(file_exists($NamaThumb))
	{
		$pathfile_source=$DirFileLocation.$FileName;
		$pathfile_thumb=$NamaThumb;
		regImgThumb($pathfile_source,$pathfile_thumb);
		return str_replace("thumb/","thumb-".date("ymdhis")."--",$NamaThumb);
	}
}

function thumbnailxx($vdir_upload,$fupload_name,$dst_width) //-> Not Used
{
	$_SESSION["sess"]["ThumbName"]=$PolaNama	= "thumb-".$dst_width."-".$fupload_name;
	$NamaThumb  = $vdir_upload.$PolaNama;
	if(file_exists($vdir_upload.$fupload_name) && !file_exists($NamaThumb))
	{
		//identitas file asli
		$im_src 	= imagecreatefromjpeg($vdir_upload.$fupload_name);
		$src_width 	= imageSX($im_src);
		$src_height = imageSY($im_src);
		
		//Simpan dalam versi small 100 pixel
		//Set ukuran gambar hasil perubahan
		$dst_width = $dst_width;
		$dst_height = ($dst_width/$src_width)*$src_height;
		
		//proses perubahan ukuran
		$im = imagecreatetruecolor($dst_width,$dst_height);
		imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		//Simpan gambar
		imagejpeg($im,$NamaThumb);
		
		//Hapus gambar di memori komputer
		imagedestroy($im_src);
		imagedestroy($im);
		
		$GbrGallery = mysqli_fetch_assoc(mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM gallery WHERE gbr_gallery='".$fupload_name."'"));
		mysqli_query($_SESSION["sess"]["koneksi"],"INSERT INTO gallery_thumbnail (id_gallery,gbr_thumbnail) VALUES ('".$GbrGallery["id_gallery"]."', '".$NamaThumb."')");
	}
	return $NamaThumb;
}

function thumbyoutubevideo($idvidads)
{
	// $qry="SELECT * FROM user_vidads WHERE idvidads='".$idvidads."'";
	// $imgvidads = mysqli_fetch_array(mysqli_query($_SESSION["sess"]["koneksi"],$qry));
	
	// if(!@copy("http://img.youtube.com/vi/".$EmbedCode."/0.jpg", $FileThumb)){ 
	// 				copy("images/no-vidimg.jpg", $FileThumb);
					
	// 				//$errors= error_get_last();
	// 				// echo "COPY ERROR: ".$errors['type'];
	// 				//echo "<br />\n".$errors['message'];
	// }
	// if($imgvidads["imgfile"]!="" && file_exists("userdata/vidads/".$imgvidads["imgfile"])) $imgfile = $imgvidads["imgfile"];
	// else{ 	if(!file_exists("userdata/vidads/no-vidimg.jpg")){
	// 			if(!file_exists("userdata/")) mkdir("userdata/");
	// 			if(!file_exists('userdata/index.html')) fopen('userdata/index.html', "w");	
	// 			if(!file_exists("userdata/vidads/")) mkdir("userdata/vidads/");
	// 			if(!file_exists('userdata/vidads/index.html')) fopen('userdata/vidads/index.html', "w");
	// 			copy("images/no-vidimg.jpg", "userdata/vidads/no-vidimg.jpg"); 
	// 		} $imgfile = "no-vidimg.jpg"; }
	// return $imgfile;
}

function regImgThumb($pathfile_source,$pathfile_thumb)
{
	
	$qry="SELECT * FROM sys_thumb WHERE pathfile_source='".$pathfile_source."' AND pathfile_thumb='".$pathfile_thumb."' ";
	if(cekdata($qry)==0)
	{
		#list($SrcWidth, $SrcHeight, $type, $attr) = getimagesize('userdata/thumb'.$_SESSION["sess"]["ThumbName"]);
		$filesize=filesize($pathfile_thumb);
		$qry="INSERT INTO sys_thumb SET 	pathfile_source='".$pathfile_source."', 
											pathfile_thumb='".$pathfile_thumb."', 
											filesize='".$filesize."'";
		runquery($qry);
	}
}

function delImgThumb($pathfile_source)
{
	$qry="SELECT * FROM sys_thumb WHERE pathfile_source='".$pathfile_source."'";
	$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
	while($mfa=mysqli_fetch_array($mqr))
	{
		if(file_exists($mfa["pathfile_thumb"])) unlink($mfa["pathfile_thumb"]);
	}

	runquery("DELETE FROM sys_thumb WHERE pathfile_source='".$pathfile_source."'");
}

function rotateImage($pathfile_source="",$degrees=90)
{
	// Load the image
	$source = imagecreatefromjpeg($pathfile_source);

	// Rotate
	$rotate = imagerotate($source, $degrees, 0);

	//and save it on your server...
	imagejpeg($rotate, $pathfile_source);
	imagedestroy($source);
}

function cropImage($param=array())
{
	if(is_array($param) && isset($param["pathfile"]) && file_exists($param["pathfile"]) && isset($param["x"]) && isset($param["y"]) && isset($param["width"]) && isset($param["height"]))
	{
		$im  = imagecreatefromjpeg($param["pathfile"]);
		$im2 = imagecrop($im, ['x'=>$param["x"], 'y'=>$param["y"], 'width'=>$param["width"], 'height'=>$param["height"]]);
		if ($im2 !== FALSE){
			imagejpeg($im2, $param["pathfile"]);
			imagedestroy($im2);
			return true;
		}else return false;
		imagedestroy($im);
	}else return false;
}

?>