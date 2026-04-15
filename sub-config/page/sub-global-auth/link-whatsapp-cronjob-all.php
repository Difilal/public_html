<?php //exit;

if(	($_SERVER['HTTP_HOST']=="adms.pmpland.co.id:1111" || 
    $_SERVER['HTTP_HOST']=="worker-wa-sync.pmpland.co.id:1111" || 
    $_SERVER['HTTP_HOST']=="config-tams.irwan.id") && isset($_POST["idwa_worker"]))
{
    
	$tglvalid=DateBySecond(60*60*12,"-");
	runQuery("UPDATE data_log_wa SET status_kirim='expire' WHERE waktu<'".$tglvalid."' AND status_kirim='queue'");    


	
    $idwa_worker = explode(",",$_POST["idwa_worker"]);
    for($i=0;$i<count($idwa_worker);$i++)
    {
        $idwa = $idwa_worker[$i];
        include("link-whatsapp-cronjob-all-sub.php");

        // $cronjob_last_operation=substr($nohp_wa["cronjob_last_operation"],0,10);
        // if(date("Y-m-d")!=$cronjob_last_operation) $cronjob_operation="0";
        // else $cronjob_operation=$nohp_wa["cronjob_operation"]+1;
        // runQuery("UPDATE data_nohp_wa SET cronjob_operation='".$cronjob_operation."', cronjob_last_operation='".date("Y-m-d H:i:s")."' WHERE idwa='".$idwa."'");
    }
    
	if(isset($report) && is_array($report)) echo json_encode($report);

    
}