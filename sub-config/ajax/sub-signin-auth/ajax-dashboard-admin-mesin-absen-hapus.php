<?php 

$idmesin    = $_POST["idmesin"]??"";
$qry        = "DELETE FROM data_absensi_mesin WHERE idmesin='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$idmesin)."' LIMIT 1";

if(runQuery($qry))  $status["respon"]="success";
else                $status["respon"]="Gagal hapus data mesin";

echo json_encode($status);