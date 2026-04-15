<?php
	$dbhost	= "localhost";
	if(	substr($_SERVER['HTTP_HOST'],-15)=="smpn1sumber.com")
	{       
        $dbuser	= "smpnsumb_smpn1su";
		$dbpass	= "NeM;z*d-vQx-"; 
		$dbname	= "smpnsumb_smpn1sumber";	
		ini_set("display_errors",0);
		$_SESSION["sess"]["online"]=1;
	}
	elseif(	substr($_SERVER['HTTP_HOST'],-15)=="sman1sumber.com")
	{
        $dbuser	= "smpnsumb_smpn1su";
		$dbpass	= "NeM;z*d-vQx-";
		$dbname	= "smpnsumb_sman1sumber"; 
		ini_set("display_errors",0);
		$_SESSION["sess"]["online"]=1;
	}
	else
	{
		$dbuser	= "root";
		$dbpass	= "";
		$dbname	= "absensi_notif";
		ini_set("display_errors",0);
		$_SESSION["sess"]["online"]=0;
	}
	$mysql_port=3306;
	$_SESSION["sess"]["koneksi"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);

    /*$arr = get_defined_vars();
    echo "<pre>";
    print_r($arr);
    echo "</pre>";*/

	// Create connection
	$_SESSION["sess"]["connect"] = new mysqli($dbhost,$dbuser,$dbpass,$dbname,$mysql_port); 
	// Check connection
	if ($_SESSION["sess"]["connect"]->connect_error) { //die("Connection failed: " . $_SESSION["sess"]["connect"]->connect_error); 
		die("Connection failed"); 
	} 
?>