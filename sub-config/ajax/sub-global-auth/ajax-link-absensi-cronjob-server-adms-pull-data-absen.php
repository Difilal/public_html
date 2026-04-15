<?php

$sn_post     = (isset($_POST["SN"]) && isJson($_POST["SN"]))?json_decode($_POST["SN"],true):[];
$_GET["vendor"] = isset($_POST["vendor"])?$_POST["vendor"]:"";

$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["adms"];
$status=[]; $status["checkinout"]=[];

if(count($sn_post)>0)
{
	// foreach($sn_post AS $sn_key=>$sn_mesin_absen)
	$qryAbsen="SELECT * FROM checkinout WHERE SN IN ('".join("','",$sn_post)."') ORDER BY checktime ASC LIMIT 50";
	if(cekData($qryAbsen)>0)
	{
		foreach(getData($qryAbsen,"","all")["data"] AS $absen)
		{
			// $absen["badgenumber"]=getData("userinfo","userid='".$absen["userid"]."' LIMIT 1","badgenumber");
			$userAdms				= getData("userinfo","userid='".$absen["userid"]."'");
			$absen["badgenumber"]	= $userAdms["badgenumber"];
			$badgeNumber			= $userAdms["badgenumber"]-0;
			$pathfile_FotoAbsen		= "D:/iclockSvr/mysite/files/upload/".$absen["SN"]."/".date("Y")."/".date("md")."/".FilterNumber(FormatWaktu($absen["checktime"],"full"))."_".$badgeNumber.".jpg";
			//logFile($pathfile_FotoAbsen);
			if(file_exists($pathfile_FotoAbsen))
			{
				$pathFolder1	= "D:/irwan/!htdocs/pmpland_2022/file-absensi/";		if(!file_exists($pathFolder1)) mkdir($pathFolder1);
				$pathFolder2	= "D:/irwan/!htdocs/pmpland_2022/file-wa-notif-sync/";	if(!file_exists($pathFolder2)) mkdir($pathFolder2);
				$namaFile		= FilterNumber(substr($absen["checktime"],0,10))."_".FilterNumber(FormatWaktu($absen["checktime"],"full"))."_".$userAdms["badgenumber"]."_".$absen["SN"].".jpg";
				$fullPathUrl	= "http://".$_SERVER['HTTP_HOST']."/file-absensi/".$namaFile;
				if(copy($pathfile_FotoAbsen,$pathFolder1.$namaFile) && copy($pathfile_FotoAbsen,$pathFolder2.$namaFile)){ unlink($pathfile_FotoAbsen); }
			}

			$abc["SN"]					= $absen["SN"];
			$abc["idabsen"]				= $absen["id"];
			$abc["dataAbsen"]			= $absen;
			$abc["fotoAbsen"]			= $fullPathUrl??"";
			$abc["namaFile_fotoAbsen"]	= $namaFile??"";
			array_push($status["checkinout"],$abc);
		}

	}
}
else $status["respon"]="Invalid Request";

if(count($status["checkinout"])>0)
{
	$status["respon"] = "success";
	$status["vendor"] = $_GET["vendor"];
}
else
{
	$status["respon"] = "Tidak ada data absen";
	$status["vendor"] = $_GET["vendor"];
}

echo json_encode($status);
$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["default"];