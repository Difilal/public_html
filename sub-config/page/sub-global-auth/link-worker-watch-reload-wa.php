<?php

include("tag/link-mysql-hosting-server.php");

// if(!isset($_POST["jmlhWaAktif"]) || !isset($_POST["jmlhEmailAktif"])) exit;


$qryIdWaWorker="SELECT idwa FROM data_nohp_wa WHERE status_layanan='aktif ' AND nohp_wa IN (SELECT DISTINCT nohp_pengirim FROM data_log_wa WHERE status_kirim='queue')";
$mqrIdWaWorker=mysqli_query($_SESSION["sess"]["koneksi"],$qryIdWaWorker); $idwa_worker=array();
while($mfaIdWaWorker=mysqli_fetch_array($mqrIdWaWorker)){ array_push($idwa_worker,$mfaIdWaWorker["idwa"]); }

$status["idwa_worker"] = join(",",$idwa_worker);

if(isset($status) && is_array($status)) echo json_encode($status);