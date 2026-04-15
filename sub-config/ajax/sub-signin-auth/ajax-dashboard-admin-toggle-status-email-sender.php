<?php

if(!isset($_POST["idsmtp"])) exit;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ceksmtp =cekdata("data_email_sender","idsmtp='".escStringDB($_POST["idsmtp"])."'");
$datasmtp=getdata("data_email_sender","idsmtp='".escStringDB($_POST["idsmtp"])."'");

if($ceksmtp>0)
{
    if($datasmtp["smtp_status"]=="disconnected")
    {
        $testSendMail=testSendMail($datasmtp["idsmtp"]);

        if($testSendMail=="success")
        {
            $qry="UPDATE data_email_sender SET smtp_status='connected' WHERE idsmtp='".$datasmtp["idsmtp"]."'";
            if(runQuery($qry))  $status["respon"]="success connected";
            else                $status["respon"]="Response Failed[".__LINE__."]";
        }
        else
        {
            $status["respon"]=$testSendMail;
        }
    }
    elseif($datasmtp["smtp_status"]=="connected")
    {
        $qry="UPDATE data_email_sender SET smtp_status='disconnected' WHERE idsmtp='".$datasmtp["idsmtp"]."'";
        if(runQuery($qry))  $status["respon"]="success disconnected";
        else                $status["respon"]="Response Failed[".__LINE__."]";
    }
}
else
{
    $status["respon"]="Data email sender tidak valid";
}


echo json_encode($status);