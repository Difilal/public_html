<?php

// echo "bla bla bla ".(isset($_GET["sn"])?$_GET["sn"]:"sn");

// if(!isset($_GET["sn"]) || $_GET["sn"]==""){ /* echo "exit"; */ exit; }/* else{ echo 'isset sn mesin absen'; } */
// $sn_mesin_absen = $_GET["sn"];

if(!isset($_POST["sn"]) || $_POST["sn"]==""){ echo "exit"; exit; }/* else{ echo 'isset sn mesin absen'; } */
$sn_mesin_absen = $_POST["sn"];

$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["adms"];
$sn                  = "'".join("','",explode("___",$sn_mesin_absen))."'";
$qryCek              = "SELECT * FROM checkinout WHERE SN IN(".$sn.") LIMIT 1";
$status["allrow"]    = getData($qryCek,"","all");
$status["data"]      = $status["allrow"]["data"];
$status["count"]     = $status["allrow"]["count"];
// $status["qryCek"]    = $qryCek;

echo json_encode($status);