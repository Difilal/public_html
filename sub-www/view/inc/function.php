<?php
function Thumb43($DirFileLocation,$FileName,$ThumbWidth,$ThumbHeight,$BgColor="white",$DirThumbToSave="thumb/",$CopyQuality=90)/* $BgColor(NoBG,black,white) */
{
	$dst_width = $ThumbWidth;
	$_SESSION["sess"]["ExecFunction"]='Thumb43';
	$_SESSION["sess"]["ThumbName"]=$PolaNama = $ThumbWidth.'x'.$ThumbHeight."-bg".$BgColor."-".$FileName;
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
?>