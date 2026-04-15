<?php sleep(1);


if(!isset($_POST["idsmtp"])) exit;
elseif(cekdata("data_email_sender","idsmtp='".escStringDB($_POST["idsmtp"])."'")==0) $status["respon"]="Akun SMTP tidak valid.";
elseif(cekdata("data_email_sender","idsmtp='".escStringDB($_POST["idsmtp"])."' AND smtp_status='connected'")==1) $status["respon"]="Disconnect terlebih dahulu akun SMTP.";
else
{
	$qry="DELETE FROM data_email_sender WHERE idsmtp='".escStringDB($_POST["idsmtp"])."'";
	if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)) $status["respon"]="success";
	else $status["respon"]="Response Failed[".__LINE__."]";
}

if(isset($status)) echo json_encode($status);