<?php

if(!isset($_POST["apikey"]) || $_POST["apikey"]!="bismillah123"){ echo "exit code"; exit; }


if(isset($_POST["getData"]) && $_POST["getData"]=="dataOutboxHosting")
{
    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["wa_notif_hosting"]; ######## SWITCH SESSION CONNECTION ########
    ####################################################################################################
 
    $qry                        = "SELECT * FROM kirim";
    $data["dataOutboxHosting"]  = getData($qry,"","all");
    

    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"]; ######## SWITCH SESSION CONNECTION ########
    // ##############################################################################################

    $data["dataQry1"]  = getData($_POST["qry"][1],"","all");
    $data["dataQry2"]  = getData($_POST["qry"][2],"","all");
    $data["dataQry3"]  = getData($_POST["qry"][3],"","all");
    

    runQuery("UPDATE data_log_wa SET status_kirim='pending' WHERE status_kirim='queue'   AND waktu>'".date("Y-m-d H:i:s")."'");
    runQuery("UPDATE data_log_wa SET status_kirim='queue'   WHERE status_kirim='pending' AND waktu<'".date("Y-m-d H:i:s")."'");
}
elseif(isset($_POST["getData"]) && $_POST["getData"]=="getOutboxByNoWa")
{
    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["wa_notif_hosting"]; ######## SWITCH SESSION CONNECTION ########
    ####################################################################################################
 
    $qry    = "SELECT * FROM kirim LIMIT 50";
    $data   = getData($qry,"","all");

    
    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"]; ######## SWITCH SESSION CONNECTION ########
    ####################################################################################*########
}
elseif(isset($_POST["delData"]) && $_POST["delData"]=="delOutboxByIdKirim")
{
    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["wa_notif_hosting"]; ######## SWITCH SESSION CONNECTION ########
    ####################################################################################################
 
    $IdKirim="'".join("','",$_POST["IdKirim"])."'";
    $qry    = "DELETE FROM kirim WHERE id_kirim IN (".$IdKirim.")";
    if(runQuery($qry)) $data["respon"]="delete success";

    
    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"]; ######## SWITCH SESSION CONNECTION ########
    ####################################################################################*########
}
// elseif(isset($_POST["blockInvalidNumber"]) && is_array($_POST["blockInvalidNumber"]))
elseif(isset($_POST["blockInvalidNumber"]))
{
    $data["step1"]=1;
    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"]; ######## SWITCH SESSION CONNECTION ########
    ##############################################################################################
    
    if(isset($_POST["dataInvalidNumber"]) && is_array($_POST["dataInvalidNumber"]) && count($_POST["dataInvalidNumber"])>0)
    {
        foreach($_POST["dataInvalidNumber"] AS $key=>$val)
        {   $data["step2"]=1;
            if($val["status_kirim"]=="3")
            {
                $data["step3"]=1;
                setStatusNoHP($val["nomor_pengirim_kirim"],"nonaktif");
                $qry="  UPDATE data_log_wa SET status_kirim='invalid_number' 
                        WHERE nohp_tujuan='".$val["nomor_pengirim_kirim"]."' AND pesan='".$val["pesan_kirim"]."' LIMIT 1";
                if(runQuery($qry)) $data["step4"]=$qry;
            }
        }
    }
}
elseif(isset($_POST["syncInbox"]))
{

    $_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"]; ######## SWITCH SESSION CONNECTION ########
    ####################################################################################*#########

    $dataInbox      = $_POST["dataInbox"];
    $nohp_pengirim  = FormatNoHP($dataInbox["from_message"]);
    $nohp_tujuan    = FormatNoHP($dataInbox["to_message"]);

    $qry2="INSERT INTO data_log_wa SET  tipe_pesan  = 'inbox',
                                    nohp_pengirim   = '".$nohp_pengirim."',
                                    nohp_tujuan     = '".$nohp_tujuan."',
                                    pesan           = '".escStringDB($dataInbox["body_message"])."',
                                    status_kirim    = 'received',
                                    waktu           = '".$dataInbox["date_message"]."'";
    if(runQuery($qry2)) $data["respon"]="success"; else $data["respon"]="sync failed";
    // $qry3="DELETE FROM message WHERE id_message='".$dataInbox["id_message"]."' OR from_message='status@broadcast' OR body_message=''";
}
else
{
    $data = array("respon"=>"null");
}


if(     isset($data) && is_array($data))    $data;
elseif( isset($data) && !is_array($data))   $data=array("respon"=>"invalid json","data"=>$data);
else                                        $data=array("respon"=>"unset variable : data");


echo json_encode($data);