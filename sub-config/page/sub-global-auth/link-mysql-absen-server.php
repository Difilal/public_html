<?php
	/*$dbhost	= "185.201.9.192";
	$dbuser	= "root";
	//$dbuser	= "djc";
	//$dbpass	= "Xq6u5C01";
	$dbpass	= "djc12345";
	$dbname	= "fp_solution_master";
	$mysql_port=3306;*/

	$dbhost	= "103.39.48.194";
	//$dbhost	= "server.pmpland.co.id";
    $dbuser	= "pmpland";
    $dbpass	= "dewisartika11";
    $dbname	= "adms_db";
    $mysql_port=3344;

	$_SESSION["sess"]["koneksi"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);

	// Create connection
	$_SESSION["sess"]["connect"] = new mysqli($dbhost,$dbuser,$dbpass,$dbname,$mysql_port); 
	// Check connection
	if ($_SESSION["sess"]["connect"]->connect_error) { die("Connection failed: " . $_SESSION["sess"]["connect"]->connect_error); 
		//die("Connection failed : ".__LINE__); 
	}
?>