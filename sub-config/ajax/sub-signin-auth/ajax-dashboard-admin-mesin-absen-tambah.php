<?php 

$idcabang       = $_POST["idcabang"]??"";
$serial_number  = $_POST["serial_number"]??"";
$cek_duplikat   = cekData("data_absensi_mesin","serial_number='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$serial_number)."'");
$status_layanan = $_POST["status_layanan"]??"";


$qry="  INSERT INTO data_absensi_mesin 
        SET         idcabang        	= '".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$idcabang)."',
                    serial_number   	= '".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$serial_number)."',
                    status_layanan  	= '".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$status_layanan)."',
                    tgl_register    	= '".date("Y-m-d H:i:s")."',
                    cronjob_operation	= 0";

if($cek_duplikat>0)     $status["respon"]="Serial number duplikat";
else
{
    if(runQuery($qry))  $status["respon"]="success";
    else                $status["respon"]="Gagal tambah data mesin";
}

echo json_encode($status);