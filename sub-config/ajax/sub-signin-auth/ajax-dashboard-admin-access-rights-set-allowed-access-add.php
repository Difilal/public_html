<?php

if(!isset($_POST["accessRights_idaccess"]) || !isset($_POST["accessRights_idkaryawan"])) exit;

$accessRights_idaccess   = $_POST["accessRights_idaccess"];
$accessRights_idkaryawan = $_POST["accessRights_idkaryawan"];
$cekKaryawan             = cekData("data_karyawan","iduser='".escStringDB($_POST["accessRights_idkaryawan"])."'");
$karyawan                = getData("data_karyawan","iduser='".escStringDB($_POST["accessRights_idkaryawan"])."'");
$allow_access=getData("sys_hak_akses_utama","idaccess='".escStringDB($accessRights_idaccess)."'","allow_access");
if($allow_access!="") $allow_access=json_decode($allow_access,true); else $allow_access=array();
if(!in_array($accessRights_idkaryawan,$allow_access)) array_push($allow_access,$accessRights_idkaryawan);


if($cekKaryawan>0)
{
    $count_allow_access=count($allow_access);
    $allow_access=json_encode($allow_access);
    $qry ="UPDATE sys_hak_akses_utama SET     allow_access    ='".escStringDB($allow_access)."'
                                    WHERE   idaccess        ='".escStringDB($accessRights_idaccess)."'";
                    
    if(runQuery($qry)){
                        $status["respon"]="success";
                        $status["nama_karyawan"]=$karyawan["nama"];
                        $status["count_allow_access"]=$count_allow_access;
    }
    else               $status["respon"]="Response Failed[".__LINE__."]";
}
else $status["respon"]="Karyawan tidak valid";


echo json_encode($status);