<?php

if(	getenv('REMOTE_ADDR')=="127.0.0.1" || $_SERVER['HTTP_HOST']=="adms.pmpland.abc")
{
	$dbhost	= "localhost";
	$dbuser	= "root";
	$dbpass	= "";
	$dbname	= "pmpland_2022";
	ini_set("display_errors",1);
	$_SESSION["sess"]["online"]=0;
}
elseif(	$_SERVER['HTTP_HOST']=="adms.pmpland.co.id:1111")
{  
	$dbhost		= "serverallah.com";
	$dbuser		= "u5529271_apptag";
	$dbpass		= "_vQP9jGx;Mh7ZSHwQN";
	$dbname		= "u5529271_apptag";
	ini_set("display_errors",0);
	$_SESSION["sess"]["online"]=1;
}
// elseif(	$_SERVER['HTTP_HOST']=="admsx.pmpland.co.id:1111")
// {       
// 	$dbhost	= "app.pmpland.co.id";
// 	$dbuser	= "suryatos_tag";
// 	$dbpass	= "aq12wsAQ!@WS";
// 	$dbname	= "suryatos_tagx";	
// 	ini_set("display_errors",1);
// 	$_SESSION["sess"]["online"]=1;
// }
else
{
	ini_set("display_errors",1);
	$_SESSION["sess"]["online"]=1;

	$dbhost		= "serverallah.com";
	$dbuser		= "u5529271_apptag";
	$dbpass		= "_vQP9jGx;Mh7ZSHwQN";
	$dbname		= "u5529271_apptag";
}
	$mysql_port=3306;
	$_SESSION["sess"]["koneksi"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);

?>