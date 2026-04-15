<?php

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

$_GET["pg"] 							= 	isset($_GET["pg"]) 								? $_GET["pg"]							: 'index';
$_GET["ajax"] 							= 	isset($_GET["ajax"]) 							? $_GET["ajax"]							: '0';
$_GET["admin"] 							= 	isset($_GET["admin"]) 							? $_GET["admin"]						: '0';
$_GET["operator"] 						= 	isset($_GET["operator"]) 						? $_GET["operator"]						: '0';
$_GET["member"] 						= 	isset($_GET["member"]) 							? $_GET["member"]						: '0';
$_SESSION["sess"]["iduser"] 			= 	isset($_SESSION["sess"]["iduser"]) 				? $_SESSION["sess"]["iduser"]			: '0';
$_SESSION["sess"]["role"] 				= 	isset($_SESSION["sess"]["role"]) 				? $_SESSION["sess"]["role"]				: 'guest';
$_SESSION["sess"]["base_role"] 			= 	isset($_SESSION["sess"]["base_role"]) 			? $_SESSION["sess"]["base_role"]		: 'guest';
$_SESSION["sess"]["jabatan"] 			= 	isset($_SESSION["sess"]["jabatan"]) 			? $_SESSION["sess"]["jabatan"]			: 'guest';
$_SESSION["sess"]["base_profile"] 		= 	isset($_SESSION["sess"]["base_profile"]) 		? $_SESSION["sess"]["base_profile"]		: 'guest';
$_SESSION["sess"]["app_siteURL"] 		= 	isset($_SESSION["sess"]["app_siteURL"]) 		? $_SESSION["sess"]["app_siteURL"]		: 'https://pmpland.co.id/';
$_SESSION["sess"]["domReff"] 			=	[
												"pmpland.abc",
												"pmpland.co.id",
												"appweb.pmpland.abc",
												"appweb.pmpland.co.id",
												"configweb.pmpland.abc",
												"configweb.pmpland.co.id",

												"webdev.pmpland.abc",
												"webdev.pmpland.co.id",
												"appwebdev.pmpland.abc",
												"appwebdev.pmpland.co.id",
												"configwebdev.pmpland.abc",
												"configwebdev.pmpland.co.id",
												"app.serverfilal.site"
											];