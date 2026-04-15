<?php 

$idmesin        = $_POST["idmesin"]??"";
$idcabang       = $_POST["idcabang"]??"";
$serial_number  = $_POST["serial_number"]??"";
$cek_duplikat   = cekData("data_absensi_mesin","idmesin!='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$idmesin)."' AND serial_number='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$serial_number)."'");
$status_layanan = $_POST["status_layanan"]??"";


$qry="  UPDATE  data_absensi_mesin 
        SET     idcabang        ='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$idcabang)."',
                serial_number   ='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$serial_number)."',
                status_layanan  ='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$status_layanan)."'
        WHERE   idmesin         ='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$idmesin)."' LIMIT 1";

if($cek_duplikat>0)     $status["respon"]="Serial number duplikat";
else
{
    if(runQuery($qry))  $status["respon"]="success";
    else                $status["respon"]="Gagal update data mesin";
}

echo json_encode($status);