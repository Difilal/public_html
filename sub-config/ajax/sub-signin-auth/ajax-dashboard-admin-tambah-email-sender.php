<?php

if(!isset($_POST["mode"])) exit;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$datasmtp["smtp_name"]=$_POST["smtp_name"];
$datasmtp["smtp_host"]=$_POST["smtp_host"];
$datasmtp["smtp_user"]=$_POST["smtp_user"];
$datasmtp["smtp_pswd"]=$_POST["smtp_pswd"];
$datasmtp["smtp_port"]=FilterNumber($_POST["smtp_port"]);
if($datasmtp["smtp_port"]=="") $datasmtp["smtp_port"]=0;
$datasmtp["smtp_secure"]=$_POST["smtp_secure"];
$datasmtp["smtp_auth"]=$_POST["smtp_auth"];
$datasmtp["smtp_status"]=$_POST["smtp_status"];

$qryCekEmail="SELECT idsmtp FROM data_email_sender where smtp_user='".escStringDB($datasmtp["smtp_user"])."'";

if(    $datasmtp["smtp_name"]==""){ $cek=1; $status["respon"]="Nama kontak wajib diisi"; }
elseif($datasmtp["smtp_host"]==""){ $cek=1; $status["respon"]="Hostname wajib diisi"; }
elseif($datasmtp["smtp_user"]==""){ $cek=1; $status["respon"]="Email wajib diisi"; }
elseif(cekdata($qryCekEmail)>0){ $cek=1; $status["respon"]="Email telah terdaftar sebelumnya"; }
elseif($datasmtp["smtp_pswd"]==""){ $cek=1; $status["respon"]="Password wajib diisi"; }
elseif($datasmtp["smtp_port"]==0) { $cek=1; $status["respon"]="Port wajib diisi"; }

if(!isset($cek))
{
    if($_POST["mode"]=="tesKoneksi")
    {
        $status["respon"]=testSendMail(0,$datasmtp);
    }
    else
    {
        $qry ="INSERT INTO data_email_sender (smtp_name,smtp_host,smtp_user,smtp_pswd,smtp_port,smtp_secure,smtp_auth,smtp_status)";
        $qry.="VALUES ( '".escStringDB($datasmtp["smtp_name"])."',
                        '".escStringDB($datasmtp["smtp_host"])."',
                        '".escStringDB($datasmtp["smtp_user"])."',
                        '".escStringDB(PasswordEncrypt($datasmtp["smtp_pswd"]))."',
                        '".escStringDB($datasmtp["smtp_port"])."',
                        '".escStringDB($datasmtp["smtp_secure"])."',
                        '".escStringDB($datasmtp["smtp_auth"])."',
                        '".escStringDB($datasmtp["smtp_status"])."')";
                        
        if(runQuery($qry)) $status["respon"]="success";
        else               $status["respon"]="Response Failed[".__LINE__."]";
    }
}

echo json_encode($status);