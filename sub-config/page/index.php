<?php


if(substr($_SERVER['SERVER_NAME'],0,12)=="server-wa-ab"){ $_SESSION["sess"]["subpg"]="link-whatsapp-atbram"; include("sub-global-auth/link-whatsapp-atbram.php"); exit; }
if(substr(		$_SERVER['SERVER_NAME'],0,17)=="server-wa-wp-sync"){ $_SESSION["sess"]["subpg"]="link-whatsapp-wa-notif-iframe"; 	include("sub-global-auth/link-whatsapp-wa-notif-iframe.php"); 	exit; }
elseif(substr(	$_SERVER['SERVER_NAME'],0,12)=="server-wa-wp"){ 	 $_SESSION["sess"]["subpg"]="link-whatsapp-wa-notif"; 	 	include("sub-global-auth/link-whatsapp-wa-notif.php"); 		exit; }
elseif(!isset($_GET["pg"]) ) exit;







?><!doctype html>
<html lang="en-us">
    <head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Platform layanan notifikasi absensi sekolah via whatsapp.">
	<meta name="google" content="notranslate">
		
	<!-- Facebook -->
    <meta property="og:url" content="<?php echo siteURL();?>">
    <meta property="og:title" content="Platform Notifikasi Absensi">
    <meta property="og:description" content="Platform layanan notifikasi absensi sekolah via whatsapp.">

    <meta property="og:image" content="<?php echo siteURL();?>img/logo-absensi.jpg">
    <meta property="og:image:secure_url" content="<?php echo siteURL();?>img/logo-absensi.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Optional JavaScript, jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
	
	
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

		$dir="sub-".$subdomain."/js/js-global-auth/";
		$jsf=listFile($dir,"js");
		foreach ($jsf as $filename){ 
			$cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
			if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
		}
		
		if($lastUpdateFile==0) $lastUpdateFile=date("ymdh");
		$jsVersion=$lastUpdateFile;
	    
        /* $filename[$f=0]="js/select2.full.min.js";
        $filename[++$f]="js/chart.min.js";
        $filename[++$f]="js/chart-custom.js";
        $filename[++$f]="js/main-script.js";
        $filename[++$f]="sub-admin/js/absensi-dashboard-script.js";
        $filename[++$f]="sub-admin/js/absensi-dashboard-script-admin.js";
        $filename[++$f]="sub-".$subdomain."/js/".$_SESSION["sess"]["subpg"].".js";
        $lastUpdateFile=0; $namaFile=0; for($g=0;$g<count($filename);$g++)
        {
            if(file_exists($filename[$g])){
                $cekLastUpdateFile[$g]=date("ymdHis", filemtime($filename[$g]));
                if($lastUpdateFile<$cekLastUpdateFile[$g]){
                    $lastUpdateFile=$cekLastUpdateFile[$g];
                    $namaFile=$filename[$g];
                }
            }
            else $cekLastUpdateFile[$g]=0;
        }   if($lastUpdateFile==0) $lastUpdateFile=date("ymdh"); */
        
	
		?><script src="<?php echo siteURL().$lastUpdateFile."-main-script-".$_SESSION["sess"]["subpg"].".js"; ?>"></script><?php


		$dir="css/";$filename=array();
        array_push($filename,$dir."main.min.css");
        array_push($filename,$dir."style.css");
		$subfilename=$dir.$_SESSION["sess"]["subpg"].".css"; 
		if(file_exists($subfilename)){ array_push($filename,$subfilename); }
		
		$lastUpdateFile=0; $namaFile=0; 
		for($g=0;$g<count($filename);$g++)
        {
			if(file_exists($filename[$g]))
			{
                $cekLastUpdateFile[$g]=date("ymdHis", filemtime($filename[$g]));
                if($lastUpdateFile<$cekLastUpdateFile[$g]){
                    $lastUpdateFile=$cekLastUpdateFile[$g];
                    $namaFile=$filename[$g];
                }//echo '/* '.$filename[$g].' */'.PHP_EOL;
            }
            else $cekLastUpdateFile[$g]=0;
        }
		
		if($lastUpdateFile==0) $lastUpdateFile=date("ymdHis");
		$cssVersion=$lastUpdateFile;

		$minifiedPath = 'css/autogen-'.$subdomain.'/style-'.$_SESSION["sess"]["subpg"].'.css';
		if(file_exists($minifiedPath)) $LastUpdateMinifiedPath=date("ymdHis", filemtime($minifiedPath)); else $LastUpdateMinifiedPath=-1;
		if($lastUpdateFile>$LastUpdateMinifiedPath) include "css/main-style.php"; 


	?>
	<link rel="stylesheet" href="<?php echo siteURL().$lastUpdateFile."--".$subdomain."--style-"."-".$_SESSION["sess"]["subpg"].".css"; ?>">
	<!-- <link rel="stylesheet" href="<?php echo siteURL().$lastUpdateFile."-generated-style-".$_SESSION["sess"]["subpg"].".css"; ?>"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
    <link rel="icon" href="img/tools.png" type="image/png" sizes="16x16">
	<title>App Config - PMPLAND</title>
    </head>
	<?php 
	if($_SESSION["sess"]["iduser"]==0)	$bodyClass=" bg-cover";
	else						$bodyClass="";
	?>
    <body class="o-page<?php echo $bodyClass; ?>" subdomain="<?php echo $subdomain; ?>" jsversion="<?php echo $jsVersion; ?>" cssversion="<?php echo $cssVersion; ?>">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        <?php  
		//if(($_SERVER['REQUEST_URI']=="/" && $_SESSION["sess"]["iduser"]>0) || $_SERVER['REQUEST_URI']!="/") 
		if($_SESSION["sess"]["iduser"]>0 && !$device->isMobile()) include("sub-".$subdomain."/page/sub-global-auth/sidebar-left.php");		
		if($_SESSION["sess"]["iduser"]>0) echo '<main class="o-page__content" style="padding-bottom:100px;">';
		
		
		include("sub-".$subdomain."/page/sub-global-auth/header.php");
		echo '<div id="contentPage" class="u-p-xsmall">';

		$subpgSigninAuth="sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php";
		$subpgGuestAuth ="sub-".$subdomain."/page/sub-guest-auth/" .$_GET["subpg"].".php";
		$subpgGlobalAuth="sub-".$subdomain."/page/sub-global-auth/".$_GET["subpg"].".php";

		if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
		elseif($_SESSION["sess"]["iduser"]>0)
		{
			if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
			else								include("sub-signin-auth/dashboard-admin-data-whatsapp-sender.php");
		}
		elseif($_SESSION["sess"]["iduser"]==0)
		{
			if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
			else								include("sub-guest-auth/login.php");
		}
		else echo "Something went wrong...";

		echo '</div>';


		if($_SESSION["sess"]["iduser"]>0) echo '</main>';
		?>

		
		
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
			  <div id="modalAlertText" class="modal-body bg-white text-black"></div>
			  <div id="modal-alert-btn-wrapper" class="modal-footer bg-light border-top-0 text-white py-2 px-2">
				<button type="button" id="btn-modal-alert" class="btn btn-secondary text-white mx-auto" data-dismiss="modal">Close</button>
			  </div>
			  <div id="modal-confirm-btn-wrapper" class="modal-footer bg-light border-top-0 text-white py-2 px-2">
				<div class="mx-auto">
					<button type="button" id="modal-btn-yes" class="c-btn c-btn--info" data-dismiss="modal" style="width: 85px;">Yes</button>
					<input type="hidden" id="btnYesCustomAttr">
					&nbsp;
					<button type="button" id="modal-btn-no"  class="c-btn c-btn--info" data-dismiss="modal" style="width: 85px;">Cancel</button>
				</div>
			  </div>
			  <div id="modal-info-btn-wrapper" class="modal-footer bg-light border-top-0 text-white py-2 px-2">
				<button type="button" id="btn-modal-info" class="c-btn c-btn--info text-white mx-auto" data-dismiss="modal">OK</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<?php //if(($_SERVER['REQUEST_URI']=="/" && $_SESSION["sess"]["iduser"]>0) || $_SERVER['REQUEST_URI']!="/") { ?>
		<?php if($_SESSION["sess"]["iduser"]==0) { ?>
		<!-- Footer
		<div class="u-text-mute u-text-small" style="display: block; width: 100%; text-align: center; padding: 10px;">
			Contact Us : <a href="https://wa.me/6285107772278" target="_blank">Whatsapp</a> | <a href="https://t.me/irwan8910" target="_blank">Telegram</a><br/>
			Please read our <a href="../privacy-policy.html">privacy policy</a> & <a href="../terms-of-service.html">terms of service</a>
		</div> -->
		<?php } ?>
		
    </body>
</html>