<?php 

//echo $_SERVER['HTTP_HOST'];

if(!isset($_GET["SN"])) $_GET["SN"]="";
//$myfile = fopen("api.txt", "w"); fwrite($myfile, "api-sync : ".$_GET["SN"]); fclose($myfile);


//if(isset($_SESSION["sess"]["koneksi"])) mysqli_close($_SESSION["sess"]["koneksi"]);
$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["adms"];

if($_GET["SN"]!="")
{
	$cekAbsen=cekData("checkinout","SN='".$_GET["SN"]."' ORDER BY checktime ASC LIMIT 1");
	if($cekAbsen>0)
	{
		$absen=getData("SELECT * FROM checkinout WHERE SN='".$_GET["SN"]."' ORDER BY checktime ASC LIMIT 1"); //echo "<pre>"; print_r($absen); echo "</pre>"; exit;
		$absen["badgenumber"]=getData("userinfo","userid='".$absen["userid"]."' LIMIT 1","badgenumber");

		$userAdms=getData("userinfo","userid='".$absen["userid"]."'");
		$badgeNumber=$userAdms["badgenumber"]-0;
		$pathfile_FotoAbsen="D:/iclockSvr/mysite/files/upload/".$_GET["SN"]."/".date("Y")."/".date("md")."/".FilterNumber(FormatWaktu($absen["checktime"],"full"))."_".$badgeNumber.".jpg";
		//logFile($pathfile_FotoAbsen);
		if(file_exists($pathfile_FotoAbsen)) 
		{
			$pathFolder="D:/xampp_htdocs/adms.pmpland.co.id/file-absensi/";
			$namaFile=FilterNumber(substr($absen["checktime"],0,10))."_".FilterNumber(FormatWaktu($absen["checktime"],"full"))."_".$userAdms["badgenumber"]."_".$_GET["SN"].".jpg";
			if(copy($pathfile_FotoAbsen,$pathFolder.$namaFile)){ unlink($pathfile_FotoAbsen); }
		}
		else
		{
			$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"];
			
			$cekDataAbsen=cekdata("data_absensi","idabsensi='".$absen["badgenumber"]."' AND waktu_absen='".$absen["checktime"]."'");
			$qry="INSERT INTO data_absensi_checkinout (badgenumber,checktime,checktype,SN)
				  VALUES ('".$absen["badgenumber"]."','".$absen["checktime"]."','".$absen["checktype"]."','".$absen["SN"]."')";
			
			if($cekDataAbsen==0) runQuery($qry);
			
			$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["adms"];
			$qry="DELETE FROM checkinout WHERE id='".$absen["id"]."' LIMIT 1";
			if(runQuery($qry)) array_push($status["respon"],array("success"=>"1","vendor"=>$_GET["vendor"],"SN"=>$_GET["SN"],"idabsen"=>$absen["id"]));
			else array_push($status["respon"],array("Error"=>mysqli_error($_SESSION["sess"]["koneksi"])));
		}
		
	
		/* array_push($status["respon"],$absen["success"]="1"); */
	}else array_push($status["respon"],array("Tidak ada record absen"=>$cekAbsen,"vendor"=>$_GET["vendor"],"SN"=>$_GET["SN"])); 
}
else array_push($status["respon"],array("failed"=>"1"));