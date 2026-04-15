<?php 

//$mainDomain=str_replace("admin.","",domainname());

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>WA WP Sync</title>
        <meta name="description" content="Marketing tools">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="75">


        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
        <!-- Optional JavaScript, jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
        <script src="<?php echo siteURL(); ?>js-jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->
        <script src="<?php echo siteURL(); ?>js-jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
        <script src="<?php echo siteURL(); ?>js-popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
        <link rel="stylesheet" href="<?php echo siteURL(); ?>css-bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="<?php echo siteURL(); ?>js-bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- <script src="<?php echo siteURL(); ?>js-link-worker.js"></script> -->

        <?php

        $dir="js/";
        $jsf=listFile($dir,"js");
        $lastUpdateFile=0;
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }

        $dir="js/autoload/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }

        $dir="sub-config/js/js-global-auth/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }
		
		if($lastUpdateFile==0) $lastUpdateFile=date("ymdh");
		$jsVersion=$lastUpdateFile;
            
        ?><script src="<?php echo siteURL().$lastUpdateFile."-main-script-".$_SESSION["sess"]["subpg"].".js"; ?>"></script>


		<link rel="shortcut icon" href="cron-icon.png" type="image/png">
        <style>
            .c-table__cell,.c-table__head--slim .c-table__cell{padding: 10px 0px 10px 15px;}
            .sup-prog-data{ color:white;background-color:#999999;padding:1px 3px;border-radius:5px;font-size: 9px;font-weight: normal; }
        </style>
    </head>
    <body class="o-page " id="body" logdata="">

        <div class="o-page__card u-width-100">
            <div class="c-card u-m-xsmallz">
                <header class="c-card__header u-p-small">
                    <!--<span class="c-card__icon" style="background: #030B5E;">
                        <i class="u-h2 fas fa-sync-alt icon-repeat" id="icox"></i>
                    </span>-->
                    <div class="u-h3 u-text-center u-m-zero" style="line-height: 1;">WHATSAPP WP SYNC</div>
                    <div class="d-none u-text-center">PMP LAND</div>
                    <div class="d-block u-text-center">
                        <smallx id="datetime_wp"><?php echo date("d/m/Y H:i:s"); ?></smallx>
                    </div>
                </header>

                <div class="c-card__body u-pt-zero">
                    <h2 class="u-h5 u-text-center u-text-bold"></h2>
                    <!--<h3 class="u-h5 u-text-center" style="color: limegreen;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>-->


                <div class="row border">
                    <div class="col">
                        <?php $data=monitoring_outboxwa_notif(); ?>

                        <div class="row border-bottom">
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_sent" class="col u-text-center u-text-bold u-p-zero" style="font-size: 32px;"><?php echo $data["count_sent"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_sent_all" class="col u-pb-zero u-text-center u-text-bold u-p-zero"><?php echo isset($data["count_sent_all"])?NumberFormat($data["count_sent_all"]):"0"; ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-xsmall u-text-center u-ph-zero">Sent</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_failed" class="col u-text-center u-text-bold u-p-zero" style="font-size: 32px;"><?php echo $data["count_failed"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_failed_all" class="col u-pb-zero u-text-center u-text-bold u-p-zero"><?php echo isset($data["count_failed_all"])?NumberFormat($data["count_failed_all"]):"0"; ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-xsmall u-text-center u-ph-zero">Failed</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_invalid_number" class="col u-text-center u-text-bold u-p-zero" style="font-size: 32px;"><?php echo $data["count_invalid_number"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_invalid_number_all" class="col u-pb-zero u-text-center u-text-bold u-p-zero"><?php echo isset($data["count_invalid_number_all"])?NumberFormat($data["count_invalid_number_all"]):"0"; ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-xsmall u-text-center u-ph-zero">Invalid</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_pending" class="col u-text-center u-text-bold u-p-zero" style="font-size: 32px;"><?php echo $data["count_pending"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_pending_all" class="col u-pb-zero u-text-center u-text-bold u-p-zero"><?php echo isset($data["count_pending_all"])?NumberFormat($data["count_pending_all"]):"0"; ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-xsmall u-text-center u-ph-zero">Pending</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_expire" class="col u-text-center u-text-bold u-p-zero" style="font-size: 32px;"><?php echo $data["count_expire"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_expire_all" class="col u-pb-zero u-text-center u-text-bold u-p-zero"><?php echo isset($data["count_expire_all"])?NumberFormat($data["count_expire_all"]):"0"; ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-xsmall u-text-center u-ph-zero">Expire</small>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div id="count_received" class="col u-text-center u-text-bold u-p-zero" style="font-size: 32px;"><?php echo $data["count_received"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_received_all" class="col u-pb-zero u-text-center u-text-bold u-p-zero"><?php echo isset($data["count_received_all"])?NumberFormat($data["count_received_all"]):"0"; ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-xsmall u-text-center u-ph-zero">Received</small>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div id="count_queue_hosting_wrapper" class="col-3 border-right">
                                <div class="row">
                                    <div id="count_queue_hosting" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_queue_hosting"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-text-center">Outbox App</small>
                                </div>
                            </div>
                            <div id="count_outbox_hosting_wrapper" class="col-3 border-right">
                                <div class="row">
                                    <div id="count_outbox_hosting" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_outbox_hosting"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-text-center u-pb-xsmall">Outbox Transit</small>
                                </div>
                            </div>
                            <div id="count_outbox_wrapper" class="col-3 border-right">
                                <div class="row">
                                    <div id="count_outbox" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_outbox"]??"0"; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Outbox Vendor</small>
                                </div>
                            </div>
                            <div class="col-3 u-p-xsmall">
                                <!-- <div class="row">
                                    <div id="count_instance" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php /* echo $data["count_instance"]; */ ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Instance</small>
                                </div> -->
                                <!-- link-whatsapp-wa-notif-sync.html -->
                                
                                <div class="row">
                                    <div class="col u-text-center u-pt-medium">
                                        <!-- <iframe src="http://server-wa-wp-sync.pmpland.abc"       frameborder="0" width="48" height="48" style="overflow: hidden;overflow-x: hidden;overflow-y: hidden;"></iframe> -->
                                        <iframe src="https://config.pmpland.co.id/link-whatsapp-wa-notif-iframe.api"       frameborder="0" width="48" height="48" style="overflow: hidden;overflow-x: hidden;overflow-y: hidden;"></iframe>
                                    </div>
                                    <div class="col-6 u-text-center u-pt-medium d-none">
                                        <!-- <iframe src="http://worker-absensi-photo.pmpland.abc:5000/"   frameborder="0" width="48" height="48" style="overflow: hidden;overflow-x: hidden;overflow-y: hidden;"></iframe> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php   $a=array();
                                foreach($data["data"] AS $key=>$val){                   $a[$val["name"]]["outboxlocal"]   = $val["count"]; }
                                foreach($data["data_outbox_hosting"] AS $key=>$val){    $a[$val["name"]]["outboxhosting"] = $val["count"]; }
                                foreach($data["data_logwa"] AS $key=>$val){             $a[$val["name"]]["logwahosting"]  = $val["count"]; }
                        ?>
                        <?php //foreach($data["data"] AS $key=>$val){ ?>
                        <?php foreach($data["list_nohp"] AS $val){ ?>
                        <div class="row border-bottom">
                            <div id="<?php  echo "qh".$val; ?>" class="col-3 border-right u-text-center"><?php echo $a[$val]["logwahosting"]; ?></div>
                            <div id="<?php  echo "ah".$val; ?>" class="col-3 border-right u-text-center"><?php echo $a[$val]["outboxhosting"]; ?></div>
                            <div id="<?php  echo "wa".$val; ?>" class="col-3 border-right u-text-center"><?php echo $a[$val]["outboxlocal"]; ?></div>
                            <div id="<?php  echo "hp".$val; ?>" class="col-3 u-text-center"><?php  echo $val; ?></div>
                        </div>
                        <?php } ?>

                        <!-- <div class="row border-bottom">
                            <div class="col"><?php //echo '$data["data"] : '.json_encode($data["data"]); ?></div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col"><?php //echo '$data["data_outbox_hosting"] : '.json_encode($data["data_outbox_hosting"]); ?></div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col"><?php //echo '$data["data_logwa"] : '.json_encode($data["data_logwa"]); ?></div>
                        </div> -->

                    </div>
                </div>


                </div>

            </div>

            <div class="o-line u-justify-center">
                <a class="u-text-mute" href="">
                    <?php // echo siteURL(); ?>
                </a>
            </div>
        </div>


                
    <?php #echo '$dbname : '.$dbname; ?>
    </body>
</html>