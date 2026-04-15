<?php

if(!isset($_POST["copiedFiles"])) exit;


$copiedFiles=$_POST["copiedFiles"];
foreach($copiedFiles AS $key=>$val)
{
    
    $pathFolder = "D:/xampp_htdocs/adms.pmpland.co.id/file-wa-notif-sync/";
    $namaFile   = $val;
    if(file_exists($pathFolder.$namaFile)) unlink($pathFolder.$namaFile);

}