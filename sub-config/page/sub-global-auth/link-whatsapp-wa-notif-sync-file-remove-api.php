<?php

if(!isset($_POST["copiedFiles"])) exit;
SettingUser("syncWA_WaApiFiles_5",date("d/m/Y H:i:s"));

$copiedFiles=$_POST["copiedFiles"];
foreach($copiedFiles AS $key=>$val)
{
    $pathFolder = "file-wa-notif-sync/";
    $namaFile   = $val;
    if(file_exists($pathFolder.$namaFile)) unlink($pathFolder.$namaFile);
    SettingUser("syncWA_WaApiFiles_6",date("d/m/Y H:i:s")." --- ".$pathFolder.$namaFile);

}