<?php

if(!isset($_POST["namaFile"]) || !isset($_POST["kontenFile"])) exit;


$pathFile = "file-absensi/index.html";
if(!file_exists($pathFile))
{
    $myfile = fopen($pathFile, "w") or die("Unable to open file!");
    fclose($myfile);
}


$namaFolder="file-absensi/".substr($_POST["namaFile"],0,8)."/";
if(!file_exists($namaFolder)) mkdir($namaFolder);


$pathFile = $namaFolder."index.html";
if(!file_exists($pathFile))
{
    $myfile = fopen($pathFile, "w") or die("Unable to open file!");
    fclose($myfile);
}


$pathFile   = $namaFolder.$_POST["namaFile"];
$myfile     = fopen($pathFile, "w") or die("Unable to open file!");
if(fwrite($myfile, $_POST["kontenFile"])){  $status["respon"]="success"; }
else{                                       $status["respon"]="failed"; }
fclose($myfile);


if(!isset($status["respon"])) $status["respon"]="undefined";
echo json_encode($status);