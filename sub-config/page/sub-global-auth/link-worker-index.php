<?php 

//$mainDomain=str_replace("admin.","",domainname());

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Worker Index</title>
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
                    <div class="u-h3 u-text-center u-m-zero" style="line-height: 1;">WORKER INDEX</div>
                    <div class="d-block u-text-center">PMP LAND</div>
                    <div class="d-block u-text-center">
                        <small><?php echo date("d/m/Y H:i:s"); ?></small>
                    </div>
                </header>

                <div class="row">
                    <div class="col-sm-6 u-text-center u-p-xsmall i-hover-yellow">
                    
                    
                    <button class="btn btn-info">WA Sync</button>
                    
                    </div>
                    <div class="col-sm-6 u-text-center u-p-xsmall i-hover-yellow">
                    
                    WA WP Sync
                    
                    </div>
                </div>

            </div>

            <div class="o-line u-justify-center">
                <a class="u-text-mute" href="">
                    <?php echo siteURL(); ?>
                </a>
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