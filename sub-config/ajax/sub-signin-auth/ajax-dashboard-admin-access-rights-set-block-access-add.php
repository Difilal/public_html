<?php

if(!isset($_POST["accessRights_idaccess"]) || !isset($_POST["accessRights_idkaryawan"])) exit;

$accessRights_idaccess   = $_POST["accessRights_idaccess"];
$accessRights_idkaryawan = $_POST["accessRights_idkaryawan"];
$cekKaryawan             = cekData("data_karyawan","iduser='".escStringDB($_POST["accessRights_idkaryawan"])."'");
$karyawan                = getData("data_karyawan","iduser='".escStringDB($_POST["accessRights_idkaryawan"])."'");
$block_access=getData("sys_hak_akses_utama","idaccess='".escStringDB($accessRights_idaccess)."'","block_access");
if($block_access!="") $block_access=json_decode($block_access,true); else $block_access=array();
if(!in_array($accessRights_idkaryawan,$block_access)) array_push($block_access,$accessRights_idkaryawan);


if($cekKaryawan>0)
{
    $count_block_access=count($block_access);
    $block_access=json_encode($block_access);
    $qry ="UPDATE sys_hak_akses_utama SET     block_access    ='".escStringDB($block_access)."'
                                    WHERE   idaccess        ='".escStringDB($accessRights_idaccess)."'";
                    
    if(runQuery($qry)){
                        $status["respon"]="success";
                        $status["nama_karyawan"]=$karyawan["nama"];
                        $status["count_block_access"]=$count_block_access;
    }
    else               $status["respon"]="Response Failed[".__LINE__."]";
}
else $status["respon"]="Karyawan tidak valid";


echo json_encode($status);