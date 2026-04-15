<?php

if(!isset($_POST["data_absen"]) || $_POST["data_absen"]<=0) exit;
$data_absen=isJson($_POST["data_absen"])?json_decode($_POST["data_absen"],true):[];

$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["adms"];
foreach($data_absen AS $val)
{
    runQuery("DELETE FROM checkinout WHERE id='".FilterNumber($val["idabsen"])."' LIMIT 1");

    $pathFolder = "D:/irwan/!htdocs/pmpland_2022/file-absensi/".$val['namaFile_fotoAbsen'];
    if($val['namaFile_fotoAbsen']!="" && file_exists($pathFolder)) unlink($pathFolder);
}