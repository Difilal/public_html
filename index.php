<?php


date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.

$zxc=array();
if(file_exists(("index_predefine_session.php"))) include("index_predefine_session.php");
session_start();


// Mengatur header HTTP untuk keamanan
header('X-Content-Type-Options: nosniff');	// Mencegah MIME-sniffing
header('X-Frame-Options: SAMEORIGIN');		// Mencegah klikjacking.
header('X-XSS-Protection: 1; mode=block');	// Mencegah serangan XSS


if(isset($_GET["exit"])) exit;
$dir="sysfiles-6d3124790042b0d1e77b7c27b288d07b/"; $listfile=scandir($dir);
foreach ($listfile as $filename){ if(substr($filename,0,9)=="function_") include($dir.$filename); }
include "vendor/autoload.php";
use Detection\MobileDetect; /* $detect = $device = new Mobile_Detect; // if(!$device->isMobile()) */
$detect = $device = new MobileDetect(); // if(!$device->isMobile())
$_SESSION["sess"]["http"] = (isset($_SERVER['HTTPS']) ? "https" : "http");


if (in_array($_SERVER['SERVER_NAME'], ["www.pmpland.co.id,app.pmpland.co.id","keuangan.pmpland.co.id","config.pmpland.co.id"]))
{
	if(substr($_SERVER['SERVER_NAME'],0,4)=="www."){ echo '<meta http-equiv="refresh" content="0;url='.$_SESSION["sess"]["http"].'://'.substr($_SERVER['SERVER_NAME'],4).$_SERVER['REQUEST_URI'].'" />'; exit; }
	if($_SESSION["sess"]["http"]=="http"){ echo '<meta http-equiv="refresh" content="0;url=https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'" />'; exit; }
}

// $b[$y++]=__LINE__."-$c \t: ".(round(microtime(true) * 1000)-$a); $c=__LINE__; ##########################################################################
// $a=round(microtime(true) * 1000); ######################################################################################################################
// ########################################################################################################################################################



include("index_predefine_global.php");
include("index_predefine_app.php");



if($_SESSION["sess"]["role"]=="admin")
{
	array_push($_SESSION["sess"]["listJabatan"],'-----','Marketing Agent'/* ,'Konsumen' */);
	if(isset($_GET["subpg"]) && ($_GET["subpg"]=="dashboard" || $_GET["subpg"]=="dashboard-admin"))
	{
		# accessRights_scanFiles("sub-app/ajax/sub-global-auth/");
		# accessRights_scanFiles("sub-app/ajax/sub-guest-auth/");
		# accessRights_scanFiles("sub-app/page/sub-global-auth/");
		# accessRights_scanFiles("sub-app/page/sub-guest-auth/");
		accessRights_scanFiles("sub-app/ajax/sub-signin-auth/");
		accessRights_scanFiles("sub-app/page/sub-signin-auth/");

		accessRights_scanFiles("sub-keuangan/ajax/sub-signin-auth/");
		accessRights_scanFiles("sub-keuangan/page/sub-signin-auth/");
	}
}

cekParamLogin();
// if(isset($_GET["subpg"]) && $_GET["subpg"]!="ajax-cronsrvtams" && !isset($_SESSION["sess"]["log"]["byPassHistory"])) UserHistory();

// $b[$y++]=__LINE__."-$c \t: ".(round(microtime(true) * 1000)-$a); $c=__LINE__; ##########################################################################
// $a=round(microtime(true) * 1000); ######################################################################################################################
// ########################################################################################################################################################

##################################################################################
##################################################################################
array_push($zxc,array("f"=>basename(__FILE__),"t"=>time(),"l"=>__LINE__));


// if(($_SERVER['HTTP_HOST']=="app.pmpland.co.id" || $_SERVER['HTTP_HOST']=="app.pmpland.net") && $_GET["pg"]=="index")
// {
// 	echo '<!--'.str_repeat(PHP_EOL,3);
// 	echo 'Aplikasi Manajemen Penjualan Perumahan'.PHP_EOL;
// 	echo 'Developed by irwan@irwan.id'.str_repeat(PHP_EOL,3);
// 	echo '-->'.str_repeat(PHP_EOL,50);
// }


ob_start("ob_html_compress");

		// echo "Line ".__LINE__.' - '.$_GET["subpg"]; exit;
	if(in_array(domainNAME(),$_SESSION["sess"]["domReff"]))
	{
		echo "test";
		if(in_array($_SERVER['SERVER_NAME'],array("pmpland.abc","pmpland.xyz","pmpland.co.id", "app.serverfilal.site")))
		{
			$subdomain="www";
			include("sub-www/index.php");
		}
		elseif(	substr($_SERVER['SERVER_NAME'],0,7)=="absensi" || 
				substr($_SERVER['SERVER_NAME'],0,12)=="worker-index" || 
				substr($_SERVER['SERVER_NAME'],0,14)=="worker-absensi" || 
				substr($_SERVER['SERVER_NAME'],0,20)=="worker-wa-monitoring" || 
				substr($_SERVER['SERVER_NAME'],0,14)=="worker-wa-sync" || 
				substr($_SERVER['SERVER_NAME'],0,20)=="worker-absensi-photo" || 
				substr($_SERVER['SERVER_NAME'],0,23)=="worker-wa-notif-file-sync")
		{
			
			$subdomain="config";
			if(!isset($_GET["subpg"]) && (siteURL()=="http://worker-absensi.pmpland.co.id:1111/" || siteURL()=="http://worker-absensi.pmpland.net:1111/"))
			{
				$_GET["subworker"] 	= 1;
				$_GET["vendor"] 	= "tag";
				$_SESSION["sess"]["subpg"] 	= $_GET["subpg"] = "link-worker-absen";
			}
			elseif(!isset($_GET["subpg"]) && siteURL()=="http://worker-wa-monitoring.pmpland.co.id:1111/")
			{
				$_GET["subworker"] 	= 1;
				$_SESSION["sess"]["subpg"] 	= $_GET["subpg"] = "link-worker-wa-monitoring";
			}
			elseif(!isset($_GET["subpg"]) && siteURL()=="http://worker-wa-sync.pmpland.co.id:1111/")
			{
				$_GET["subworker"] 	= 1;
				$_SESSION["sess"]["subpg"] 	= $_GET["subpg"] = "link-worker-wa-sync";
			}
			elseif(!isset($_GET["subpg"]) && siteURL()=="http://worker-index.pmpland.co.id:1111/")
			{
				$_GET["subworker"] 	= 1;
				$_SESSION["sess"]["subpg"] 	= $_GET["subpg"] = "link-worker-index";
			}
			elseif(!isset($_GET["subpg"]) && siteURL()=="http://worker-absensi-photo.pmpland.net/")
			{
				$_GET["subworker"] 	= 1;
				$_SESSION["sess"]["subpg"] 	= $_GET["subpg"] = "link-absensi-photo-iframe";
			}
			else $_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:'dashboard-admin-data-whatsapp-sender';
			
			
			if( 	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" 	&& $_GET["admin"]==1 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" 	&& $_GET["admin"]==1){ echo '<meta http-equiv="refresh" content="0;url='.siteURL().'dashboard.html" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0		&& $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif(	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0){ 	echo '<meta http-equiv="refresh" content="0;url='.siteURL().'login.html" />'; if($_SERVER['REQUEST_URI']!="" && !isset($_GET["directsubpg"])) $_SESSION["sess"]["log"]["REQUEST_URI"]=$_SERVER['REQUEST_URI']; exit; }
			elseif( $_GET["pg"]=="guest" 	 && $_SESSION["sess"]["iduser"]>0 		&& $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="guest" 	 && $_SESSION["sess"]["iduser"]>0){ 	echo '<meta http-equiv="refresh" content="0;url='.siteURL().'dashboard.html" />'; exit; }


			if($_GET["ajax"]==1)
			{
				#include("sub-".$subdomain."/ajax/".$_GET["subpg"].".php");
				$subpgSigninAuth="sub-".$subdomain."/ajax/sub-signin-auth/".$_GET["subpg"].".php";
				$subpgGuestAuth ="sub-".$subdomain."/ajax/sub-guest-auth/" .$_GET["subpg"].".php";
				$subpgGlobalAuth="sub-".$subdomain."/ajax/sub-global-auth/".$_GET["subpg"].".php";

				if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
				elseif($_SESSION["sess"]["iduser"]>0){
					if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
					else{								echo "Page not found"; exit; }
				}
				elseif($_SESSION["sess"]["iduser"]==0){
					if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
					else{								echo "Page not found"; exit; }
				}
				else echo "Something went wrong...";
			}
			else if($_GET["pg"]=="main-css")    include("css/".$_GET["css"].".php");
			else if($_GET["pg"]=="main-js")     include("js/".$_GET["js"].".php");
			else if($_GET["pg"]=="otomasi" || isset($_GET["directsubpg"]) || isset($_GET["loadAsync"]) || isset($_GET["subworker"]))
			{

				$subpgSigninAuth="sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php";
				$subpgGuestAuth ="sub-".$subdomain."/page/sub-guest-auth/" .$_GET["subpg"].".php";
				if(isset($_GET["vendor"])){ $_SESSION["sess"]["vendorAdms"]=$_GET["vendor"]; 	$subpgGlobalAuth="sub-".$subdomain."/page/sub-global-auth/".$_GET["vendor"]."/".$_GET["subpg"].".php"; }
				else{ 						/* unset($_SESSION["sess"]["vendorAdms"]); */		$subpgGlobalAuth="sub-".$subdomain."/page/sub-global-auth/".$_GET["subpg"].".php"; }

				if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
				elseif($_SESSION["sess"]["iduser"]>0){
					if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
					else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard-admin-data-whatsapp-sender.php");
				}
				elseif($_SESSION["sess"]["iduser"]==0){
					if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
					else								include("sub-".$subdomain."/page/sub-guest-auth/login.php");
				}
				else echo "Something went wrong...";
			}
			else 								include("sub-blank/index.php");
		}
		elseif(	substr($_SERVER['SERVER_NAME'],0,6)=="config" || 
				substr($_SERVER['SERVER_NAME'],0,12)=="server-wa-wp" || 
				substr($_SERVER['SERVER_NAME'],0,17)=="server-wa-wp-sync" ||
				$_SERVER['HTTP_HOST']=="app-server.pmpland.co.id" ||
				$_SERVER['HTTP_HOST']=="app-server.pmpland.co.id:5000")
		{
			
			$subdomain="config";
			$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:'dashboard-admin-access-rights';
			
			
			if( 	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1 && $_GET["ajax"]==1){	echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1){ 						echo '<meta http-equiv="refresh" content="0;url='.siteURL().'dashboard.html" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0 && $_GET["ajax"]==1){ 							echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif(	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0){ 												echo '<meta http-equiv="refresh" content="0;url='.siteURL().'login.html" />'; if($_SERVER['REQUEST_URI']!="" && !isset($_GET["directsubpg"])) $_SESSION["sess"]["log"]["REQUEST_URI"]=$_SERVER['REQUEST_URI']; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0 && $_GET["ajax"]==1){ 								echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0){ 													echo '<meta http-equiv="refresh" content="0;url='.siteURL().'dashboard.html" />'; exit; }


			if($_GET["ajax"]==1)
			{ 				
				#include("sub-".$subdomain."/ajax/".$_GET["subpg"].".php");
				$subpgSigninAuth="sub-".$subdomain."/ajax/sub-signin-auth/".$_GET["subpg"].".php";
				$subpgGuestAuth ="sub-".$subdomain."/ajax/sub-guest-auth/" .$_GET["subpg"].".php";
				$subpgGlobalAuth="sub-".$subdomain."/ajax/sub-global-auth/".$_GET["subpg"].".php";

				if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
				elseif($_SESSION["sess"]["iduser"]>0){
					if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
					else{								echo "Page not found"; exit; }
				}
				elseif($_SESSION["sess"]["iduser"]==0){
					if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
					else{								echo "Page not found"; exit; }
				}
				else echo "Something went wrong...";
			}
			else if($_GET["pg"]=="main-css")    include("css/".$_GET["css"].".php");
			else if($_GET["pg"]=="main-js")     include("js/".$_GET["js"].".php");
			else if($_GET["pg"]=="otomasi" || $_GET["pg"]=="api" || isset($_GET["directsubpg"]) || isset($_GET["loadAsync"])){ 

				$subpgGlobalAuth="sub-".$subdomain."/page/sub-global-auth/".$_GET["subpg"].".php";
				$subpgGuestAuth ="sub-".$subdomain."/page/sub-guest-auth/" .$_GET["subpg"].".php";
				$subpgSigninAuth="sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php";

				if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
				elseif($_SESSION["sess"]["iduser"]>0){
					if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
					else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard-admin-data-whatsapp-sender.php");
				}
				elseif($_SESSION["sess"]["iduser"]==0){
					if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
					else								include("sub-".$subdomain."/page/sub-guest-auth/login.php");
				}
				else echo "Something went wrong...";
			}
			else 										include("sub-config/page/index.php");
		}
		elseif(	substr($_SERVER['SERVER_NAME'],0,3)=="app" || 
				substr($_SERVER['SERVER_NAME'],0,2)=="dl")
		{
		
			$subdomain="app";
			//$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:'dashboard-operator-data-broadcast-informasi-general';

			if( 	isset($_GET["loadAsync"]) && 	isset($_POST["loadAsync"]) && 	!file_exists("sub-".$subdomain."/page/sub-guest-auth/".$_GET["subpg"].".php")  	&&  $_SESSION["sess"]["iduser"]==0 ){ $_GET["subpg"]="login"; }
			elseif( isset($_GET["loadAsync"]) && 	isset($_POST["loadAsync"]) && 	!file_exists("sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php") 	&&  $_SESSION["sess"]["iduser"]>0  ){ unset($_GET["subpg"]); }
			elseif( isset($_GET["loadAsync"]) && ( !isset($_POST["loadAsync"]) || 	(!file_exists("sub-".$subdomain."/page/sub-guest-auth/".$_GET["subpg"].".php") 	&& 	!file_exists("sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php"))) ){ echo json_encode(array("not_found"=>'Halaman tidak ditemukan')); exit; }

			//$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";
			// $_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";
			if($_SESSION["sess"]["base_profile"]=="Konsumen")	$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";
			else												$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard-operator-penjualan-target-data";

			$domReffDOKU=array("https://staging.doku.com/","https://pay.doku.com/");
			if(isset($_SERVER["HTTP_REFERER"])) $HTTP_REFERER=$_GET["HTTP_REFERER"]=$_SERVER["HTTP_REFERER"];
			else								$HTTP_REFERER=$_GET["HTTP_REFERER"]="";
			if(	( 
					// in_array($HTTP_REFERER,$domReffDOKU) ||
					FindInString("doku.com",$HTTP_REFERER) ||
					FindInString("app.pmpland.co.id",$HTTP_REFERER) ||
					$HTTP_REFERER==""
				)	
				&& 	isset($_POST["TRANSIDMERCHANT"]))
			{ 
				include("sub-app/page/sub-global-auth/".$_GET["subpg"].".php");
				exit;
			}
			elseif(	$_SESSION["sess"]["iduser"]>0 && $_GET["pg"]!="global" && $_GET["pg"]!="otomasi" && !accessRights())
			{ 									
				if($_GET["ajax"]==1){ 	echo 'Anda tidak memiliki hak akses'; exit; }
				else{ 					echo '<meta http-equiv="refresh" content="0;url='.siteURL().'dashboard.html" />'; exit; }
				//else{ 					echo json_encode($_GET); exit; }
			}
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1 && $_GET["ajax"]==1){ 		echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1){ 							echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_SESSION["sess"]["role"]!="operator" && $_GET["operator"]==1 && $_GET["ajax"]==1){ 	echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_SESSION["sess"]["role"]!="operator" && $_GET["operator"]==1){ 						echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif(	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0){ 					 echo '<meta http-equiv="refresh" content="0;url='.siteURL().'login.html" />'; if($_SERVER['REQUEST_URI']!="" && !isset($_GET["directsubpg"])) $_SESSION["sess"]["log"]["REQUEST_URI"]=$_SERVER['REQUEST_URI']; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0 && $_GET["ajax"]==1){ 	 echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0){ 						 echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			else
			{
				if($_GET["ajax"]==1)
				{ 				
					#include("sub-".$subdomain."/ajax/".$_GET["subpg"].".php");
					$subpgSigninAuth="sub-".$subdomain."/ajax/sub-signin-auth/".$_GET["subpg"].".php";
					$subpgGuestAuth ="sub-".$subdomain."/ajax/sub-guest-auth/" .$_GET["subpg"].".php";
					$subpgGlobalAuth="sub-".$subdomain."/ajax/sub-global-auth/".$_GET["subpg"].".php";
	
					if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
					elseif($_SESSION["sess"]["iduser"]>0){
						if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
						else{								echo "Page not found"; exit; }
					}
					elseif($_SESSION["sess"]["iduser"]==0){
						if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
						else{								echo "Page not found"; exit; }
					}
					else echo "Something went wrong...";
				}
				else if($_GET["pg"]=="main-css")    		include("css/".$_GET["css"].".php");
				else if($_GET["pg"]=="main-js")     		include("js/".$_GET["js"].".php");
				else if($_GET["pg"]=="otomasi" || isset($_GET["directsubpg"]) || isset($_GET["loadAsync"])){
	
					$subpgGlobalAuth="sub-".$subdomain."/page/sub-global-auth/".$_GET["subpg"].".php";
					$subpgGuestAuth ="sub-".$subdomain."/page/sub-guest-auth/" .$_GET["subpg"].".php";
					$subpgSigninAuth="sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php";
	
					if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
					elseif($_SESSION["sess"]["iduser"]>0){
						if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
						// else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard.php");
						// else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard-operator-penjualan-data.php");
						else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard-operator-penjualan-target-data.php");
					}
					elseif($_SESSION["sess"]["iduser"]==0){
						if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
						else								include("sub-".$subdomain."/page/sub-guest-auth/login.php");
					}
					else echo "Something went wrong...";
				}
				else 										include("sub-".$subdomain."/page/index.php");
			}

			
		}
		elseif(	substr($_SERVER['SERVER_NAME'],0,8)=="keuangan")
		{
		
			$subdomain="keuangan";
			//$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:'dashboard-operator-data-broadcast-informasi-general';

			if( 	isset($_GET["loadAsync"]) && 	isset($_POST["loadAsync"]) && 	!file_exists("sub-".$subdomain."/page/sub-guest-auth/".$_GET["subpg"].".php")  	&&  $_SESSION["sess"]["iduser"]==0 ){ $_GET["subpg"]="login"; }
			elseif( isset($_GET["loadAsync"]) && 	isset($_POST["loadAsync"]) && 	!file_exists("sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php") 	&&  $_SESSION["sess"]["iduser"]>0  ){ unset($_GET["subpg"]); }
			elseif( isset($_GET["loadAsync"]) && ( !isset($_POST["loadAsync"]) || 	(!file_exists("sub-".$subdomain."/page/sub-guest-auth/".$_GET["subpg"].".php") 	&& 	!file_exists("sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php"))) ){ echo json_encode(array("not_found"=>'Halaman tidak ditemukan')); exit; }

			//$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";
			// $_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";
			if($_SESSION["sess"]["base_profile"]=="Konsumen")	$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";
			// else												$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard-operator-penjualan-data";
			else												$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:"dashboard";

			if(isset($_SERVER["HTTP_REFERER"])) $HTTP_REFERER=$_GET["HTTP_REFERER"]=$_SERVER["HTTP_REFERER"];
			else								$HTTP_REFERER=$_GET["HTTP_REFERER"]="";
			if(	$_SESSION["sess"]["iduser"]>0 && $_GET["pg"]!="global" && $_GET["pg"]!="otomasi" && !accessRights())
			{ 									
				if($_GET["ajax"]==1){ 	echo 'Anda tidak memiliki hak akses'; exit; }
				else{ 					echo '<meta http-equiv="refresh" content="0;url='.siteURL().'dashboard.html" />'; exit; }
				//else{ 					echo json_encode($_GET); exit; }
			}
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1 && $_GET["ajax"]==1){ 		echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1){ 							echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_SESSION["sess"]["role"]!="operator" && $_GET["operator"]==1 && $_GET["ajax"]==1){ 	echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_SESSION["sess"]["role"]!="operator" && $_GET["operator"]==1){ 						echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif(	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0){ 					 echo '<meta http-equiv="refresh" content="0;url='.siteURL().'login.html" />'; if($_SERVER['REQUEST_URI']!="" && !isset($_GET["directsubpg"])) $_SESSION["sess"]["log"]["REQUEST_URI"]=$_SERVER['REQUEST_URI']; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0 && $_GET["ajax"]==1){ 	 echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0){ 						 echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			else
			{
				if($_GET["ajax"]==1)
				{ 				
					#include("sub-".$subdomain."/ajax/".$_GET["subpg"].".php");
					$subpgSigninAuth="sub-".$subdomain."/ajax/sub-signin-auth/".$_GET["subpg"].".php";
					$subpgGuestAuth ="sub-".$subdomain."/ajax/sub-guest-auth/" .$_GET["subpg"].".php";
					$subpgGlobalAuth="sub-".$subdomain."/ajax/sub-global-auth/".$_GET["subpg"].".php";
	
					if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
					elseif($_SESSION["sess"]["iduser"]>0){
						if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
						else{								echo "Page not found"; exit; }
					}
					elseif($_SESSION["sess"]["iduser"]==0){
						if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
						else{								echo "Page not found"; exit; }
					}
					else echo "Something went wrong...";
				}
				else if($_GET["pg"]=="main-css")    		include("css/".$_GET["css"].".php");
				else if($_GET["pg"]=="main-js")     		include("js/".$_GET["js"].".php");
				else if($_GET["pg"]=="otomasi" || isset($_GET["directsubpg"]) || isset($_GET["loadAsync"])){
	
					$subpgGlobalAuth="sub-".$subdomain."/page/sub-global-auth/".$_GET["subpg"].".php";
					$subpgGuestAuth ="sub-".$subdomain."/page/sub-guest-auth/" .$_GET["subpg"].".php";
					$subpgSigninAuth="sub-".$subdomain."/page/sub-signin-auth/".$_GET["subpg"].".php";
	
					if(file_exists($subpgGlobalAuth)) 		include($subpgGlobalAuth);
					elseif($_SESSION["sess"]["iduser"]>0){
						if(file_exists($subpgSigninAuth)) 	include($subpgSigninAuth);
						// else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard.php");
						else								include("sub-".$subdomain."/page/sub-signin-auth/dashboard-operator-penjualan-data.php");
					}
					elseif($_SESSION["sess"]["iduser"]==0){
						if(file_exists($subpgGuestAuth))  	include($subpgGuestAuth);
						else								include("sub-".$subdomain."/page/sub-guest-auth/login.php");
					}
					else echo "Something went wrong...";
				}
				else 										include("sub-".$subdomain."/page/index.php");
			}

			
		}
		elseif(substr($_SERVER['SERVER_NAME'],0,6)=="konsumen")
		{
			
			$subdomain="member";
			$_SESSION["sess"]["subpg"] = $_GET["subpg"] = isset($_GET["subpg"]) ? $_GET["subpg"]:'dashboard-member-belanja';
			
			if( 	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="admin" && $_GET["admin"]==1){ echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="operator" && $_GET["operator"]==1 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["role"]!="operator" && $_GET["operator"]==1){ echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }
			elseif( $_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif(	$_GET["pg"]=="dashboard" && $_SESSION["sess"]["iduser"]==0){ echo '<meta http-equiv="refresh" content="0;url='.siteURL().'login.html" />'; if($_SERVER['REQUEST_URI']!="" && !isset($_GET["directsubpg"])) $_SESSION["sess"]["log"]["REQUEST_URI"]=$_SERVER['REQUEST_URI']; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0 && $_GET["ajax"]==1){ echo "Terdapat perbedaan sesi, mohon muat ulang halaman terlebih dahulu."; exit; }
			elseif( $_GET["pg"]=="guest" && $_SESSION["sess"]["iduser"]>0){ echo '<meta http-equiv="refresh" content="0;url='.siteURL().'" />'; exit; }


			if($_GET["ajax"]==1) include("sub-member/ajax/".$_GET["subpg"].".php");
			else if($_GET["pg"]=="main-css")    include("css/".$_GET["css"].".php");
			else if($_GET["pg"]=="main-js")     include("js/".$_GET["js"].".php");
			else if($_GET["pg"]=="otomasi") 	include("sub-member/page/".$_GET["subpg"].".php");
			else if(isset($_GET["directsubpg"]))include("sub-member/page/".$_GET["subpg"].".php");
			else 								include("sub-member/page/index.php");
		}
		else
		{ 
			$subdomain="";
			echo '<meta http-equiv="refresh" content="0;url=http://pmpland.co.id/" />'; 
			exit; 
		}
	}
	else{ echo "masuk<br>"; echo siteURL(); }

ob_end_flush();


// if( isset($_SESSION["sess"]["koneksi"]))				mysqli_close($_SESSION["sess"]["koneksi"]);
// if( isset($_SESSION["sess"]["condb"]["default"]))		mysqli_close($_SESSION["sess"]["condb"]["default"]);
// if( isset($_SESSION["sess"]["condb"]["wa_notif_hosting"]))	mysqli_close($_SESSION["sess"]["condb"]["wa_notif_hosting"]);

$a=get_defined_vars();
$xtc=array("_GET", "_POST", "_COOKIE", "_SERVER", "_SESSION", "GLOBALS");
$xtc=array("_COOKIE", "_SESSION", "_SERVER", "GLOBALS");
foreach($a as $k=>$v){  if(!in_array($k,$xtc)){ /* echo $k.'<br>'; */ if(isset(${$k})) unset(${$k});  }}



// echo '<hr>';

// $a=get_defined_vars();
// $x=array("_COOKIE", "_SESSION", "_SERVER", "GLOBALS");
// foreach($a as $k=>$v)
// {
// 	if(!in_array($k,$x))
// 	{
// 		echo $k.'<br>';
// 	}
// }
