<?php

if(!isset($_POST["mode"])) exit;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$datasmtp["idsmtp"]=$_POST["idsmtp"];
$datasmtp["smtp_name"]=$_POST["smtp_name"];
$datasmtp["smtp_host"]=$_POST["smtp_host"];
$datasmtp["smtp_user"]=$_POST["smtp_user"];
$datasmtp["smtp_pswd"]=$_POST["smtp_pswd"];
$datasmtp["smtp_port"]=FilterNumber($_POST["smtp_port"]);
if($datasmtp["smtp_port"]=="") $datasmtp["smtp_port"]=0;
$datasmtp["smtp_secure"]=$_POST["smtp_secure"];
$datasmtp["smtp_auth"]=$_POST["smtp_auth"];
$datasmtp["smtp_status"]=$_POST["smtp_status"];

$qryCekEmail="SELECT idsmtp FROM data_email_sender where idsmtp   !='".escStringDB($datasmtp["idsmtp"])."' AND
                                                         smtp_user ='".escStringDB($datasmtp["smtp_user"])."'";

if(    $datasmtp["smtp_name"]==""){ $cek=1; $status["respon"]="Nama kontak wajib diisi"; }
elseif($datasmtp["smtp_host"]==""){ $cek=1; $status["respon"]="Hostname wajib diisi"; }
elseif($datasmtp["smtp_user"]==""){ $cek=1; $status["respon"]="Email wajib diisi"; }
elseif(cekdata($qryCekEmail)>0){ $cek=1; $status["respon"]="Email telah terdaftar pada record lain"; }
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
        $qry ="UPDATE data_email_sender SET smtp_name   ='".escStringDB($datasmtp["smtp_name"])."',
                                            smtp_user   ='".escStringDB($datasmtp["smtp_user"])."',
                                            smtp_pswd   ='".escStringDB(PasswordEncrypt($datasmtp["smtp_pswd"]))."',
                                            smtp_host   ='".escStringDB($datasmtp["smtp_host"])."',
                                            smtp_port   ='".escStringDB($datasmtp["smtp_port"])."',
                                            smtp_secure ='".escStringDB($datasmtp["smtp_secure"])."',
                                            smtp_auth   ='".escStringDB($datasmtp["smtp_auth"])."',
                                            smtp_status ='".escStringDB($datasmtp["smtp_status"])."'
                                            WHERE
                                            idsmtp      ='".escStringDB($datasmtp["idsmtp"])."'";
                        
        if(runQuery($qry)) $status["respon"]="success";
        else               $status["respon"]="Response Failed[".__LINE__."]";
    }
}

echo json_encode($status);