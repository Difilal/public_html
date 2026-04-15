<?php 

include("tag/link-mysql-hosting-server.php");

if(!isset($_POST["idsmtp"])) exit;
$idsmtp		= $_POST["idsmtp"];
$datasmtp	= getData("data_email_sender","idsmtp='".$idsmtp."'");
$report["page"]="";






$tglvalid=DateBySecond(60*60*6,"-");

$dataLogEmail	= getData("data_log_email","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND email_pengirim='".$datasmtp["smtp_user"]."' AND email_penerima!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 1");
$cekLogEmail	= cekData("data_log_email","waktu>='".$tglvalid."' AND waktu<='".date("Y-m-d H:i:s")."' AND email_pengirim='".$datasmtp["smtp_user"]."' AND email_penerima!='' AND status_kirim='queue' ORDER BY prioritas DESC, waktu ASC LIMIT 1");
runquery("UPDATE data_log_email SET status_kirim='expire' WHERE waktu<'".$tglvalid."' AND status_kirim='queue'");

if($cekLogEmail>0 && !isset($browserjob))
{
	$dataSendMail				=$dataLogEmail;
	$dataSendMail["idsmtp"]		=$datasmtp["idsmtp"];
	$dataSendMail["smtp_name"]	=$datasmtp["smtp_name"];
	$dataSendMail["smtp_host"]	=$datasmtp["smtp_host"];
	$dataSendMail["smtp_user"]	=$datasmtp["smtp_user"];
	$dataSendMail["smtp_pswd"]	=passwordDecrypt($datasmtp["smtp_pswd"]);
	$dataSendMail["smtp_port"]	=$datasmtp["smtp_port"];
	$dataSendMail["smtp_secure"]=$datasmtp["smtp_secure"];
	$dataSendMail["smtp_auth"]	=$datasmtp["smtp_auth"];
	$dataSendMail["smtp_status"]=$datasmtp["smtp_status"];

	$report["result"]=$result=sendMail($dataSendMail);
	if(strtolower($result)=="success")
	{
        $lama_waktu_terkirim=strtotime(date("Y-m-d H:i:s"))-strtotime($dataLogEmail["waktu"]);
		runQuery("UPDATE data_log_email SET status_kirim='sent', waktu_terkirim='".date("Y-m-d H:i:s")."', lama_waktu_terkirim='".$lama_waktu_terkirim."' WHERE idlogemail='".$dataLogEmail["idlogemail"]."' LIMIT 1");
	}
	else if(	$result=="Autentikasi gagal, periksa ulang email atau password." ||
				$result=="Gagal koneksi ke SMTP server, periksa ulang smtp server & port." )
	{
      runQuery("UPDATE data_email_sender SET smtp_status='disconnected' WHERE smtp_user='".$dataLogEmail["email_pengirim"]."'");
    } 
	else{ } 
}
else $report["result"]="No queued job";





$cronjob_last_operation=substr($datasmtp["cronjob_last_operation"],0,10);
if(date("Y-m-d")!=$cronjob_last_operation) $cronjob_operation="0";
else $cronjob_operation=$datasmtp["cronjob_operation"]+1;
runQuery("UPDATE data_email_sender SET cronjob_operation='".$cronjob_operation."', cronjob_last_operation='".date("Y-m-d H:i:s")."' WHERE idsmtp='".$idsmtp."'");


$report["smtp_name"] 					=$datasmtp["smtp_name"];
$report["smtp_user"] 					=$datasmtp["smtp_user"];
$report["dataQueueEmail"]				=cekData("data_log_email","email_pengirim='".$datasmtp["smtp_user"]."' AND status_kirim='queue'");
$report["dataSentEmailAll"]				=cekData("data_log_email","email_pengirim='".$datasmtp["smtp_user"]."' AND status_kirim='sent'");
$report["dataSentEmailToday"]			=cekData("data_log_email","email_pengirim='".$datasmtp["smtp_user"]."' AND status_kirim='sent' AND waktu LIKE '".date("Y-m-d")."%'");
$report["email_cronjobLastOperation"]	=FormatDate($datasmtp["cronjob_last_operation"])." ".FormatWaktu($datasmtp["cronjob_last_operation"],"full");
$report["email_cronjobOperation"]		=$datasmtp["cronjob_operation"]; 
$report["StatusLayananEmail"] 			=$datasmtp["smtp_status"];


if(isset($_POST["idsmtp"]) && isset($report)) echo json_encode($report);