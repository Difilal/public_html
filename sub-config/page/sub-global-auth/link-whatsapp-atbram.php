<?php 

//$mainDomain=str_replace("admin.","",domainname());

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Worker Automation</title>
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
                    <div class="u-h3 u-text-center u-m-zero" style="line-height: 1;">WORKER AUTOMATION </div>
                    <div class="d-block u-text-center">PMP LAND</div>
                    <div class="d-block u-text-center">
                        <smallx id="datetime"><?php echo date("d/m/Y H:i:s"); ?></smallx>
                    </div>
                </header>

                <div class="c-card__body u-pt-zero">
                    <h2 class="u-h5 u-text-center u-text-bold"></h2>
                    <!--<h3 class="u-h5 u-text-center" style="color: limegreen;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>-->


                <?php 
                $fncApps=array();
                array_push($fncApps,"Whatsapp AB Sync");   // data konsumen valid dari awal s.d akhir bulan, awal bulan data prospek konsumen yg tidak booking dipindahkan ke table konsumen history
                
                /* $mqr=mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM data_cabang");
                while($mfa=mysqli_fetch_array($mqr)){ 
                    array_push($fncAbsen,"Rekap Karyawan ".$mfa["nama_cabang"]);
                } */

                ?>
                <!-- <div class="row u-mb-small" style="margin-top: 20px;">
                    <div class="col">

                        <div class="c-table-responsive@desktop">	
                            <table class="c-table">



                                <thead class="c-table__head c-table__head--slim u-width-100">
                                    <tr class="c-table__row">
                                        <th class="c-table__cell c-table__cell--head u-p-small">



                                            <table width="100%" data-classes="table">
                                                <thead class="c-table__head c-table__head--slim">
                                                <tr>                                         
                                                    <td>
                                                        <div class="row u-pl-small">
                                                            <div class="col u-pr-zero">
                                                                <div class="row">
                                                                    <div class="col u-ph-zero">
                                                                        <h3 class="u-m-zero">Whatsapp AB Sync</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </thead>
                                            </table>



                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="u-pt-zero u-pr-xsmall u-pb-xsmall u-pl-zero" colspan="3">
                                            <div class="u-inline-block u-p-small u-ml-xsmall u-mt-xsmall" id="<?php echo $elmId."_wrapper"; ?>" status_layanan="" style="display:float-left;width: 300px;background-color: #EEEEEE;border-radius:10px;">
                                                <div class="row">
                                                    <div class="col-9 u-text-small" style="border-right: solid 1px lightgrey;">Progress <span id="loop_runner">0</span></div>
                                                    <div class="col-3 u-text-small u-text-center" id="whatsapp_ab_sync_progress">idle</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                
                                
                            </table>
                        </div>

                    </div>
                </div> -->

                <div class="row u-ph-zero u-pt-zero u-pb-xsmall" style="margin-top: 20px;">
                    <div class="col u-ph-zero u-text-bold" style="font-size: 32px;">Whatsapp AB Sync</div>
                </div>
                <div class="row border">
                    <div class="col">
                        <?php $data=monitoring_outbox_atbram(); ?>

                        <div class="row border-bottom">
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_sent" class="col u-text-center u-text-bold" style="font-size: 32px;"><?php echo $data["count_sent"]; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_sent_all" class="col u-pb-zero u-text-center u-text-bold"><?php if(isset($data["count_sent_all"])) echo NumberFormat($data["count_sent_all"]); ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Sent</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_failed" class="col u-text-center u-text-bold" style="font-size: 32px;"><?php echo $data["count_failed"]; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_failed_all" class="col u-pb-zero u-text-center u-text-bold"><?php if(isset($data["count_failed_all"])) echo NumberFormat($data["count_failed_all"]); ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Failed</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_invalid_number" class="col u-text-center u-text-bold" style="font-size: 32px;"><?php echo $data["count_invalid_number"]; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_invalid_number_all" class="col u-pb-zero u-text-center u-text-bold"><?php if(isset($data["count_invalid_number_all"])) echo NumberFormat($data["count_invalid_number_all"]); ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Invalid</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_pending" class="col u-text-center u-text-bold" style="font-size: 32px;"><?php echo $data["count_pending"]; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_pending_all" class="col u-pb-zero u-text-center u-text-bold"><?php if(isset($data["count_pending_all"])) echo NumberFormat($data["count_pending_all"]); ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Pending</small>
                                </div>
                            </div>
                            <div class="col-2 border-right">
                                <div class="row">
                                    <div id="count_cancel" class="col u-text-center u-text-bold" style="font-size: 32px;"><?php echo $data["count_cancel"]; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_cancel_all" class="col u-pb-zero u-text-center u-text-bold"><?php if(isset($data["count_cancel_all"])) echo NumberFormat($data["count_cancel_all"]); ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Cancel</small>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div id="count_expire" class="col u-text-center u-text-bold" style="font-size: 32px;"><?php echo $data["count_expire"]; ?></div>
                                </div>
                                <div class="row">
                                    <small id="count_expire_all" class="col u-pb-zero u-text-center u-text-bold"><?php if(isset($data["count_expire_all"])) echo NumberFormat($data["count_expire_all"]); ?></small>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Expire</small>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div id="count_outbox_wrapper" class="col-3 border-right">
                                <div class="row">
                                    <div id="count_outbox" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_outbox"]; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Outbox Local</small>
                                </div>
                            </div>
                            <div id="count_outbox_hosting_wrapper" class="col-3 border-right">
                                <div class="row">
                                    <div id="count_outbox_hosting" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_outbox_hosting"]; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-text-center u-pb-xsmall">Outbox Hosting</small>
                                </div>
                            </div>
                            <div id="count_queue_hosting_wrapper" class="col-3 border-right">
                                <div class="row">
                                    <div id="count_queue_hosting" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_queue_hosting"]; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-text-center">Queue Hosting</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div id="count_instance" class="col u-text-center u-text-bold" style="font-size: 64px;"><?php echo $data["count_instance"]; ?></div>
                                </div>
                                <div class="row">
                                    <small class="col u-pb-small u-text-center">Instance</small>
                                </div>
                            </div>
                        </div>
                        
                        <?php   $a=array();
                                foreach($data["data"] AS $key=>$val){                   $a[$val["name"]]["outboxlocal"]   = $val["count"]; }
                                foreach($data["data_outbox_hosting"] AS $key=>$val){    $a[$val["name"]]["outboxhosting"] = $val["count"]; }
                                foreach($data["data_logwa"] AS $key=>$val){             $a[$val["name"]]["logwahosting"]  = $val["count"]; }
                        ?>
                        <?php //foreach($data["data"] AS $key=>$val){ ?>
                        <?php foreach($a AS $key=>$val){ ?>
                        <div class="row border-bottom">
                            <div id="<?php  echo "wa".$key; ?>" class="col-3 border-right u-text-center"><?php echo $a[$key]["outboxlocal"]; ?></div>
                            <div id="<?php  echo "ah".$key; ?>" class="col-3 border-right u-text-center"><?php echo $a[$key]["outboxhosting"]; ?></div>
                            <div id="<?php  echo "qh".$key; ?>" class="col-3 border-right u-text-center"><?php echo $a[$key]["logwahosting"]; ?></div>
                            <div id="<?php  echo "hp".$key; ?>" class="col-3 u-text-center"><?php  echo $key; ?></div>
                        </div>
                        <?php } ?>

                    </div>
                </div>


                </div>

            </div>

            <div class="o-line u-justify-center">
                <a class="u-text-mute" href="">
                    <?php echo siteURL(); ?>
                </a>
            </div>
        </div>


                
    <?php #echo '$dbname : '.$dbname; ?>
    </body>
</html>