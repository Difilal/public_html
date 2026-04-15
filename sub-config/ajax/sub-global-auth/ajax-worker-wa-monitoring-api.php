<?php

if(!isset($_POST["wa_worker"])) exit;



$a=getData("SELECT * FROM data_nohp_wa","","all");
$status["nowa"]=$status["idwa"]=array();
foreach($a["data"] AS $key=>$val)
{
    array_push($status["nowa"],$val["nohp_wa"]);
    array_push($status["idwa"],$val["idwa"]);
    $b=getData("SELECT status_kirim, COUNT(*) AS total FROM data_log_wa WHERE nohp_pengirim='".$val["nohp_wa"]."' OR nohp_tujuan='".$val["nohp_wa"]."' GROUP BY status_kirim","","all");
    foreach($b["data"] AS $key2=>$val2)
    {
        if( $val2["status_kirim"]=="queue")      $status["dataQueue".$val["idwa"]]       = $val2["total"];
        if( $val2["status_kirim"]=="sent")       $status["dataSentAll".$val["idwa"]]     = $val2["total"];
        if( $val2["status_kirim"]=="received")   $status["dataReceivedAll".$val["idwa"]] = $val2["total"];
    }
    if(!isset($status["dataQueue".$val["idwa"]]))       $status["dataQueue".$val["idwa"]]       = 0;
    if(!isset($status["dataSentAll".$val["idwa"]]))     $status["dataSentAll".$val["idwa"]]     = 0;
    if(!isset($status["dataReceivedAll".$val["idwa"]])) $status["dataReceivedAll".$val["idwa"]] = 0;


    $c=getData("SELECT status_kirim, COUNT(*) AS total FROM data_log_wa WHERE waktu LIKE '".date("Y-m-d")."%' AND (nohp_pengirim='".$val["nohp_wa"]."' OR nohp_tujuan='".$val["nohp_wa"]."') GROUP BY status_kirim","","all");
    foreach($c["data"] AS $key3=>$val3)
    {
        if( $val3["status_kirim"]=="sent")       $status["dataSentToday".$val["idwa"]]     = $val3["total"];
        if( $val3["status_kirim"]=="received")   $status["dataReceivedToday".$val["idwa"]] = $val3["total"];
    }
    if(!isset($status["dataSentToday".$val["idwa"]]))     $status["dataSentToday".$val["idwa"]]     = 0;
    if(!isset($status["dataReceivedToday".$val["idwa"]])) $status["dataReceivedToday".$val["idwa"]] = 0;

}



$status["totalDataDefaultSender"] = cekData("SELECT last_wa_sender FROM data_karyawan WHERE last_wa_sender IN(SELECT nohp_wa FROM data_nohp_wa)");
$status["totalDataDefaultSender"]+= cekData("SELECT last_wa_sender FROM data_agent    WHERE last_wa_sender IN(SELECT nohp_wa FROM data_nohp_wa)");
$status["totalDataDefaultSender"]+= cekData("SELECT last_wa_sender FROM data_konsumen WHERE last_wa_sender IN(SELECT nohp_wa FROM data_nohp_wa)");


$a=getData("SELECT status_kirim, COUNT(*) AS total FROM data_log_wa GROUP BY status_kirim","","all");
foreach($a["data"] AS $key=>$val)
{
    if(     $val["status_kirim"]=="queue")      $status["totalDataQueue"]       = $val["total"];
    elseif( $val["status_kirim"]=="sent")       $status["totalDataSentAll"]     = $val["total"];
    elseif( $val["status_kirim"]=="received")   $status["totalDataReceivedAll"] = $val["total"];
}
if(!isset($status["totalDataQueue"]))       $status["totalDataQueue"]       = 0;
if(!isset($status["totalDataSentAll"]))     $status["totalDataSentAll"]     = 0;
if(!isset($status["totalDataReceivedAll"])) $status["totalDataReceivedAll"] = 0;


$a=getData("SELECT status_kirim, COUNT(*) AS total FROM data_log_wa WHERE waktu LIKE '".date("Y-m-d")."%' GROUP BY status_kirim","","all");
foreach($a["data"] AS $key=>$val)
{
    if(     $val["status_kirim"]=="sent")       $status["totalDataSentToday"]     = $val["total"];
    elseif( $val["status_kirim"]=="received")   $status["totalDataReceivedToday"] = $val["total"];
}
if(!isset($status["totalDataSentToday"]))       $status["totalDataSentToday"]     = 0;
if(!isset($status["totalDataReceivedToday"]))   $status["totalDataReceivedToday"] = 0;



echo json_encode($status);