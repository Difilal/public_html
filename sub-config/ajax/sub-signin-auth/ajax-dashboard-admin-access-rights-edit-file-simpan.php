<?php

$idaccess               = $_POST["idaccess"]??-1;
$modulAccessRights      = trim($_POST["modulAccessRights"]??"");
$submodulAccessRights   = trim($_POST["submodulAccessRights"]??"");

if($idaccess<1) $status["respon"]="ID Akses tidak valid";
elseif($modulAccessRights=="")
{
    $qryUpdate  = "UPDATE sys_hak_akses_utama SET idmodul='0' WHERE idaccess='".escStringDB($idaccess)."'";
    if(runQuery($qryUpdate)) $status["respon"]="success";
    else $status["respon"]="Gagal update modul";   
}
elseif($modulAccessRights=="nonmodul")
{
    $qryUpdate  = "UPDATE sys_hak_akses_utama SET idmodul='-1' WHERE idaccess='".escStringDB($idaccess)."'";
    if(runQuery($qryUpdate)) $status["respon"]="success";
    else $status["respon"]="Gagal update modul";   
}
elseif($modulAccessRights=="" || $submodulAccessRights=="") $status["respon"]="Nama modul wajib diisi";
else
{
    $qry="  SELECT * FROM sys_hak_akses_modul 
            WHERE   nama_modul  ='".escStringDB($modulAccessRights)."' AND 
                    sub_modul   ='".escStringDB($submodulAccessRights)."'";

    if(cekData($qry)<1)
    {
        $qryInsert="INSERT INTO sys_hak_akses_modul 
                    SET nama_modul  ='".escStringDB($modulAccessRights)."', 
                        sub_modul   ='".escStringDB($submodulAccessRights)."'";
        runQuery($qryInsert);

        // mysqli_query($_SESSION["sess"]["koneksi"],$qryInsert) or die(mysqli_error($_SESSION["sess"]["koneksi"]));
    }

    $modul      = getData($qry);
    $qryUpdate  = "UPDATE sys_hak_akses_utama SET idmodul='".$modul["idmodul"]."' WHERE idaccess='".escStringDB($idaccess)."'";

    if(runQuery($qryUpdate)) $status["respon"]="success";
    else $status["respon"]="Gagal update modul";

}

$qryClearModul="DELETE FROM sys_hak_akses_modul WHERE idmodul IN (SELECT m.idmodul FROM `sys_hak_akses_modul` m LEFT JOIN sys_hak_akses_utama u ON m.idmodul=u.idmodul WHERE u.idmodul IS null)";
runQuery($qryClearModul);
echo json_encode($status);