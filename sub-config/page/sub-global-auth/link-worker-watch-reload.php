<?php

// include("tag/link-mysql-hosting-server.php");

if(!isset($_POST["jmlhWaAktif"]) || !isset($_POST["jmlhEmailAktif"])) exit;

$function_worker     = array();
$jmlhWaAktif         = $_POST["jmlhWaAktif"];
$jmlhEmailAktif      = $_POST["jmlhEmailAktif"];

/* $jmlhWaAktif2        = cekdata("data_nohp_wa","status_layanan='aktif'");       if($jmlhWaAktif==0)         */$jmlhWaAktif2    =2;
/* $jmlhEmailAktif2     = cekdata("data_email_sender","smtp_status='connected'"); if($jmlhEmailAktif==0)      */$jmlhEmailAktif2 =2;

if( $jmlhWaAktif!=$jmlhWaAktif2 || 
    $jmlhEmailAktif!=$jmlhEmailAktif2)  $status["respon"]="reload";// [".$jmlhEmailAktif.":".$jmlhEmailAktif2."]"; 
else                                    $status["respon"]="#stayhome";




echo json_encode($status);