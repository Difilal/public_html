<?php 

//$mainDomain=str_replace("admin.","",domainname());

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>WA Monitoring</title>
        <meta name="description" content="Marketing tools">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="300">


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

        $dir="sub-config/js/js-guest-auth/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }

        $dir="sub-config/js/js-signin-auth/";
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
                        <small><?php echo date("d/m/Y H:i:s"); ?></small>
                    </div>
                </header>

                <div class="c-card__body">
                    <h2 class="u-h5 u-text-center u-text-bold"></h2>
                    <!--<h3 class="u-h5 u-text-center" style="color: limegreen;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>-->


                
                    
                    
                <?php
                $qry="SELECT * FROM data_nohp_wa";
                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                $JumlahNohpWa=mysqli_num_rows($mqr);
                ?>
                <div class="row u-mb-large" style="margin-top: 20px;">
                    <div class="col-sm-12">

                        <div class="c-table-responsive@desktop">	
                        <table class="c-table c-table--highlight">



                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th colspan="9" class="c-table__cell c-table__cell--head u-p-small">                                 


                                        <table width="100%" data-classes="table">
                                            <thead class="c-table__head c-table__head--slim">
                                            <tr>
                                                <td>
                                                    <div class="row u-pl-small">
                                                        <div class="col-12 u-pr-zero">
                                                            <div class="row">
                                                                <div class="col u-ph-zero">
                                                                    <h3 class="u-m-zero">Whatsapp Monitoring</h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col u-ph-zero"><?php
                                                                    echo "Jumlah : ".NumberFormat($JumlahNohpWa); 
                                                                ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </thead>
                                        </table>


                                    </th>
                                </tr>
                                <tr class="c-table__row">
                                  <th class="c-table__cell c-table__cell--head">Nohp Whatsapp</th>
                                  <th class="c-table__cell c-table__cell--head">Default</th>
                                  <th class="c-table__cell c-table__cell--head">Queue</th>
                                  <th class="c-table__cell c-table__cell--head">Sent</th>
                                  <th class="c-table__cell c-table__cell--head">Received</th>
                                  <th class="c-table__cell c-table__cell--head">Expire</th>
                                  <!-- <th class="c-table__cell c-table__cell--head">Worker Progress</th>
                                  <th class="c-table__cell c-table__cell--head">Status Layanan</th>
                                  <th class="c-table__cell c-table__cell--head" style="width: 70px;">
                                      <span class="u-hidden-visually">Actions</span>
                                  </th> -->
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                $totalDataQueue=$totalDataSentAll=$totalDataSentToday=$totalDataReceivedAll=$totalDataReceivedToday=$totalDataExpireAll=$totalDataExpireToday=$totalDataDefaultSender=0;
                                while($mfa=mysqli_fetch_array($mqr)){ 

                                        
                                    if(!isset($idwa_worker)) $idwa_worker=array();
                                    if($mfa["status_layanan"]=="aktif") array_push($idwa_worker,$mfa["idwa"]);
                                    
                                    
                                ?>
                                <tr id="idwa<?php echo $mfa["idwa"]; ?>" class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>" status_layanan="<?php echo $mfa["status_layanan"]; ?>">
                                    <td class="c-table__cell" id="NoHpWa<?php echo $mfa["idwa"]; ?>">
                                        <?php echo $mfa["nohp_wa"]; ?>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DefaultSender<?php echo $mfa["idwa"]; ?>"><?php 

                                        $cekTabelLogin=cekData("data_karyawan","last_wa_sender='".$mfa["nohp_wa"]."'");
                                        $cekTabelSiswa=cekData("data_konsumen","last_wa_sender='".$mfa["nohp_wa"]."'");
                                        echo $DefaulSender=$cekTabelLogin+$cekTabelSiswa;
                                        $totalDataDefaultSender+=$DefaulSender;

                                        ?></span>
                                    </td>

                                    <td class="c-table__cell" id="dataQueue<?php echo $mfa["idwa"]; ?>-wrapper">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="dataQueue<?php echo $mfa["idwa"]; ?>"><?php 
                                        $dataQueue=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='queue'");
                                        $totalDataQueue+=$dataQueue;
                                        echo NumberFormat($dataQueue); 

                                        ?></span>
                                    </td>

                                    <td class="c-table__cell" id="dataSentAll<?php echo $mfa["idwa"]; ?>-wrapper">
                                        <span class="u-p-xsmall" style="border-radius: 10px;"><?php 
                                        $dataSent=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='sent'");
                                        $totalDataSentAll+=$dataSent;

                                        $dataSupSent=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='sent' AND waktu LIKE '".date("Y-m-d")."%'");
                                        $totalDataSentToday+=$dataSupSent;

                                        echo '<span id="dataSentAll'.$mfa["idwa"].'">';
                                        echo NumberFormat($dataSent);
                                        echo '</span>';

                                        if($dataSupSent>0) $cssStyle=''; else $cssStyle='style="display:none;"';
                                        echo '<sup class="sup-prog-data" id="dataSentToday'.$mfa["idwa"].'" '.$cssStyle.'>+';
                                        echo numberFormat($dataSupSent);
                                        echo "</sup>";   

                                        ?></span>
                                    </td>

                                    <td class="c-table__cell" id="dataReceivedAll<?php echo $mfa["idwa"]; ?>-wrapper">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaReceived<?php echo $mfa["idwa"]; ?>"><?php 
                                        $dataReceived=cekData("data_log_wa","nohp_tujuan='".$mfa["nohp_wa"]."' AND status_kirim='received'");
                                        $totalDataReceivedAll+=$dataReceived;

                                        $dataSupReceived=cekData("data_log_wa","nohp_tujuan='".$mfa["nohp_wa"]."' AND status_kirim='received' AND waktu LIKE '".date("Y-m-d")."%'");
                                        $totalDataReceivedToday+=$dataSupReceived;

                                        echo '<span id="dataReceivedAll'.$mfa["idwa"].'">';
                                        echo NumberFormat($dataReceived); 
                                        echo '</span>';

                                        if($dataSupReceived>0) $cssStyle=''; else $cssStyle='style="display:none;"';
                                        echo '<sup class="sup-prog-data" id="dataReceivedToday'.$mfa["idwa"].'" '.$cssStyle.'>+';
                                        echo numberFormat($dataSupReceived);
                                        echo "</sup>";   
                                        
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaExpire<?php echo $mfa["idwa"]; ?>"><?php 
                                        $dataExpire=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='expire'");
                                        $totalDataExpireAll+=$dataExpire;

                                        $dataSupExpire=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='expire' AND waktu LIKE '".date("Y-m-d")."%'");
                                        $totalDataExpireToday+=$dataSupExpire;

                                        echo '<span id="dataExpireAll'.$mfa["idwa"].'">';
                                        echo NumberFormat($dataExpire); 
                                        echo '</span>';

                                        if($dataSupExpire>0) $cssStyle=''; else $cssStyle='style="display:none;"';
                                        echo '<sup class="sup-prog-data" id="dataExpireToday'.$mfa["idwa"].'" '.$cssStyle.'>+';
                                        echo numberFormat($dataSupExpire);
                                        echo "</sup>";   
                                        
                                        ?></span>
                                    </td>

                                    <!-- <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaCronjob<?php echo $mfa["idwa"]; ?>"><?php 
                                            echo '<span id="cronjobLastOperation'.$mfa["idwa"].'">';
                                            echo FormatDate($mfa["cronjob_last_operation"])." ".FormatWaktu($mfa["cronjob_last_operation"],"full");
                                            echo '</span>';
                                            
                                            echo '<sup class="sup-prog-data" id="cronjobOperation'.$mfa["idwa"].'">+';
                                            echo NumberFormat($mfa["cronjob_operation"]); 
                                            echo "</sup>"; 
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="StatusLayananWa<?php echo $mfa["idwa"]; ?>">
                                        <?php if($mfa["status_layanan"]=="aktif"){ ?>
                                        <i class="fa fa-check u-color-success u-mr-xsmall"></i>Aktif
                                        <?php }elseif($mfa["status_layanan"]=="nonaktif"){ ?>
                                        <i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Nonaktif
                                        <?php } ?>
                                        </span>
                                    </td>

                                    <td class="c-table__cell u-text-right" id="worker_wa<?php echo $mfa["idwa"]; ?>"><?php
                                    
                                    if($mfa["status_layanan"]=="aktif") echo "idle";
                                    else echo '<i class="fas fa-times u-color-danger"></i>';
                                    
                                    ?></td> -->
                                </tr>
                                <?php } ?>

                            </tbody>

                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row" id="JumlahDataWA">
                                    <th class="c-table__cell">Jumlah Data</th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="totalDataDefaultSender"><?php 
                                            echo NumberFormat($totalDataDefaultSender); 
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="totalDataQueue"><?php 
                                            echo NumberFormat($totalDataQueue); 
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumSent"><?php 
                                            echo '<span id="totalDataSentAll">';
                                            echo NumberFormat($totalDataSentAll); 
                                            echo "</span>";   

                                            if($totalDataSentToday>0) $cssStyle=''; else $cssStyle='style="display:none;"';
                                            echo '<sup class="sup-prog-data" id="totalDataSentToday" '.$cssStyle.'>+';
                                            echo numberFormat($totalDataSentToday);
                                            echo "</sup>";   
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumReceived"><?php 
                                            echo '<span id="totalDataReceivedAll">';
                                            echo NumberFormat($totalDataReceivedAll); 
                                            echo "</span>";   
                                            
                                            if($totalDataReceivedToday>0) $cssStyle=''; else $cssStyle='style="display:none;"';
                                            echo '<sup class="sup-prog-data" id="totalDataReceivedToday" '.$cssStyle.'>+';
                                            echo numberFormat($totalDataReceivedToday);
                                            echo "</sup>";   
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumExpire"><?php 
                                            echo '<span id="totalDataExpireAll">';
                                            echo NumberFormat($totalDataExpireAll); 
                                            echo "</span>";   
                                            
                                            if($totalDataExpireToday>0) $cssStyle=''; else $cssStyle='style="display:none;"';
                                            echo '<sup class="sup-prog-data" id="totalDataExpireToday" '.$cssStyle.'>+';
                                            echo numberFormat($totalDataExpireToday);
                                            echo "</sup>";   
                                        ?></span>
                                    </th>
                                    <!-- <th class="c-table__cell c-table__cell--head"></th>
                                    <th class="c-table__cell c-table__cell--head"></th>
                                    <th class="c-table__cell c-table__cell--head"></th> -->
                                </tr>
                            </thead>
                            
                            
                        </table>
                        </div>

                    </div>
                </div>



                </div>

            </div>

            <div class="o-line u-justify-center">
                <a class="u-text-mute" href="">
                    <?php echo siteURL(); ?>
                </a>

                <input type="hidden" id="wa_worker"         value="1">
                <input type="hidden" id="idwa_list"         value="<?php if(isset($idwa_worker)) echo join(",",$idwa_worker); ?>">
                <input type="hidden" id="idwa_worker"       value="<?php #if(isset($idwa_worker)) echo join(",",$idwa_worker); ?>">
                <input type="hidden" id="jmlhWaAktif"       value="<?php $jmlhWaAktif=cekdata("data_nohp_wa","status_layanan='aktif'"); echo $jmlhWaAktif; ?>">

            </div>
        </div>


		
		<!-- Modal -->
		<div class="modal" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div id="modal-body" class="modal-dialog modal-dialog-centered" role="document">
			<div id="modal-content" class="modal-content bg-secondary border-0">
			  <div id="modal-header" class="modal-header bg-secondary py-1 px-2" style="border:none;border-bottom:1px solid #555555;">
				<h5 id="modal-title-alert" class="modal-title text-light" style="line-height:32px;">
					<i class="fa fa-exclamation-triangle u-mr-xsmall"></i>
					<span style="font-size: 20px;">peringatan</span>
				</h5>
				<h5 id="modal-title-confirm" class="modal-title text-light" style="line-height:32px;">
					<i class="fa fa-question-circle u-mr-xsmall"></i>
					<span style="font-size: 20px;">konfirmasi</span>
				</h5>
				<h5 id="modal-title-info" class="modal-title text-light" style="line-height:32px;">
					<i class="fa fa-info-circle u-mr-xsmall"></i>
					<span style="font-size: 20px;" id="modal-title-info-text">informasi</span>
				</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div id="modalAlertText" class="modal-body bg-white text-black" style="overflow-wrap: break-word;"></div>
			  <div id="modal-alert-btn-wrapper" class="modal-footer bg-light border-top-0 text-white py-2 px-2">
				<button type="button" id="btn-modal-alert" class="btn btn-secondary text-white mx-auto" data-dismiss="modal">Close</button>
			  </div>
			  <div id="modal-confirm-btn-wrapper" class="modal-footer bg-light border-top-0 text-white py-2 px-2">
				<div class="mx-auto">
					<button type="button" id="modal-btn-yes" class="btn btn-info text-white" data-dismiss="modal" style="width: 75px;">Yes</button>
					&nbsp;
					<button type="button" id="modal-btn-no" class="btn btn-info text-white" data-dismiss="modal" style="width: 75px;">Cancel</button>
				</div>
			  </div>
			  <div id="modal-info-btn-wrapper" class="modal-footer bg-light border-top-0 text-white py-2 px-2">
				<button type="button" id="btn-modal-info" class="btn btn-info text-white mx-auto" data-dismiss="modal">OK</button>
			  </div>
			</div>
		  </div>
		</div>
                
    <?php #echo '$dbname : '.$dbname; ?>
    </body>
</html>