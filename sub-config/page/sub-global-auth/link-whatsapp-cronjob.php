<?php //exit;

if(	$_SERVER['HTTP_HOST']=="adms.pmpland.co.id:1111" || $_SERVER['HTTP_HOST']=="admsx.pmpland.co.id:1111")
{
	

	include("tag/link-mysql-hosting-server.php");

	if(isset($_POST["idwa"])) 	$idwa = $_POST["idwa"];
	if(isset($_GET["idwa"])) 	$idwa = $_GET["idwa"];
	$nohp_wa	= getData("data_nohp_wa","idwa='".$idwa."'");
	/* $sekolah	= getData("data_sekolah","idsekolah='".$nohp_wa["idsekolah"]."'");
	$angkatan	= getData("data_angkatan","idangkatan='".$nohp_wa["idangkatan"]."'"); */
	$report["page"]="";

	$tglvalid=DateBySecond(60*60*12,"-");

	$LogWA		= getData("data_log_wa","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND nohp_tujuan!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 1");
	$cekLogWA	= cekData("data_log_wa","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND nohp_tujuan!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 1");
	runquery("UPDATE data_log_wa SET status_kirim='expire' WHERE waktu<'".$tglvalid."' AND status_kirim='queue'");

	if($cekLogWA>0 && !isset($browserjob))
	{

		$report["idlogwa"]			=$LogWA["idlogwa"];
		$report["nohp_tujuan"]		=$LogWA["nohp_tujuan"];
		$report["nohp_tujuan_md5"]	=md5($LogWA["nohp_tujuan"]);
		$report["pesan"]			=nl2br($LogWA["pesan"]);
		$report["pesan_md5"]		=md5(nl2br($LogWA["pesan"]));
		$report["waktu"]			=$LogWA["waktu"];
		$report["waktu_md5"]		=md5($LogWA["waktu"]);
		$report["status_kirim"]		=$LogWA["status_kirim"];
		
		
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
		
		$report["result"]=$result=apiWhatsapp($dataApiWa); // $report["result"]=$result=apiWhatsapp($nohp_wa["api_key"],$phone_no,$message,$nama_file,$sendType);
		$report["result_md5"]=md5($report["result"]);

		$report["resultxxx"]=$result." : ".$nama_file;

		if($result>0)
		{    
			runQuery("UPDATE data_log_wa SET status_kirim='progress', idlogwa_api='".escStringDB($result)."' WHERE idlogwa='".$LogWA["idlogwa"]."' LIMIT 1");
		}
		else if(strtolower($result)=="success" || strtolower($result)=="false" || $result==false || $result==1 || $result=="1")
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


	if($nohp_wa["vendor"]=="pesanenter")
	{
		$cekLogWA2 	= cekData("data_log_wa","status_kirim='progress' ORDER BY waktu ASC LIMIT 1");
		if($cekLogWA2==1)
		{
			$LogWA2 	= getData("data_log_wa","status_kirim='progress' ORDER BY waktu ASC LIMIT 1");
			$result		= []/* apiPesanEnter_GetMsgById($nohp_wa["api_key"],$LogWA2["idlogwa_api"]) */;
			if($result=="success")
			{
				$lama_waktu_terkirim=strtotime(date("Y-m-d H:i:s"))-strtotime($LogWA2["waktu"]);
				runQuery("UPDATE data_log_wa SET status_kirim='sent', waktu_terkirim='".date("Y-m-d H:i:s")."', lama_waktu_terkirim='".$lama_waktu_terkirim."' WHERE idlogwa='".$LogWA2["idlogwa"]."' LIMIT 1");
				
				if(substr($LogWA2["send_group"],0,3)=="bcg")
				{
					$cekBcgTotal	= cekdata("data_log_wa","send_group='".$LogWA2["send_group"]."'");
					$cekBcgTerkirim = cekdata("data_log_wa","send_group='".$LogWA2["send_group"]."' AND status_kirim='sent'");
					$cekBcgQueue 	= cekdata("data_log_wa","send_group='".$LogWA2["send_group"]."' AND status_kirim='queue'");
					if($cekBcgQueue==0 || $cekBcgTotal==$cekBcgTerkirim) runQuery("UPDATE data_broadcast_general SET status='sent' WHERE send_group='".$LogWA2["send_group"]."'");
				}	
			}
			else if($result=="number_not_found"/*  || $result=="not_found" */)
			{
				runQuery("UPDATE data_log_wa SET status_kirim='invalid_number' WHERE idlogwa='".$LogWA2["idlogwa"]."'");
			}
			else if($result=="not_found")
			{
				$wkt=DateBySecond(60,"-");
				/* $qryxxx="UPDATE data_log_wa SET status_kirim='unknown' WHERE idlogwa='".$LogWA2["idlogwa"]."' AND waktu<'".$wkt."'"; */
				$qryxxx="UPDATE data_log_wa SET status_kirim='sent' WHERE idlogwa='".$LogWA2["idlogwa"]."' AND waktu<'".$wkt."'";
				runQuery($qryxxx); 
				$report["unknownRespon"]=$result." => ".$LogWA2["idlogwa_api"]." => ".$qryxxx;
			}
			else $report["resultGetMsgById"]=$LogWA2["nohp_tujuan"]." : ".$result." => ".$LogWA2["nohp_pengirim"];
		} //$report["GetMsgById_respon"]=$result;
	} //else $report["GetMsgById_respon"]="xxxxxxxx";




	$cronjob_last_operation=substr($nohp_wa["cronjob_last_operation"],0,10);
	if(date("Y-m-d")!=$cronjob_last_operation) $cronjob_operation="0";
	else $cronjob_operation=$nohp_wa["cronjob_operation"]+1;
	runQuery("UPDATE data_nohp_wa SET cronjob_operation='".$cronjob_operation."', cronjob_last_operation='".date("Y-m-d H:i:s")."' WHERE idwa='".$idwa."'");


	$report["NoHpWa"] 				=$nohp_wa["nohp_wa"];
	$report["StatusLayananWa"] 		=$nohp_wa["status_layanan"];
	$report["NamaCabang"] 			=getData("data_cabang",	 "idcabang='".$nohp_wa["idcabang"]."'", "nama_cabang");
	$report["DefaultSender"] 		=cekData("data_karyawan",	 "last_wa_sender='".$nohp_wa["nohp_wa"]."'");
	$report["DefaultSender"]	   +=cekData("data_konsumen","last_wa_sender='".$nohp_wa["nohp_wa"]."'");
	$report["dataQueue"]			=cekData("data_log_wa","nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND status_kirim='queue'");
	$report["dataSentAll"]			=cekData("data_log_wa","nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND status_kirim='sent'");
	$report["dataSentToday"]		=cekData("data_log_wa","nohp_pengirim='".$nohp_wa["nohp_wa"]."' AND status_kirim='sent' AND waktu LIKE '".date("Y-m-d")."%'");
	$report["dataReceivedAll"]		=cekData("data_log_wa","nohp_tujuan='".$nohp_wa["nohp_wa"]."' AND status_kirim='received'");
	$report["dataReceivedToday"]	=cekData("data_log_wa","nohp_tujuan='".$nohp_wa["nohp_wa"]."' AND status_kirim='received' AND waktu LIKE '".date("Y-m-d")."%'");
	$report["cronjobLastOperation"]	=FormatDate($nohp_wa["cronjob_last_operation"])." ".FormatWaktu($nohp_wa["cronjob_last_operation"],"full");
	$report["cronjobOperation"]		=$nohp_wa["cronjob_operation"]; 


	if(isset($_POST["idwa"]) && isset($report)) echo json_encode($report);


}