<?php
	$dbhost	= "localhost";
	$dbuser	= "root";
	$dbpass	= "";
	$dbname	= "absensi_notif";
	$mysql_port=3306;
	$_SESSION["sess"]["koneksi"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);

	// Create connection
	$_SESSION["sess"]["connect"] = new mysqli($dbhost,$dbuser,$dbpass,$dbname,$mysql_port); 
	// Check connection
	if ($_SESSION["sess"]["connect"]->connect_error) { //die("Connection failed: " . $_SESSION["sess"]["connect"]->connect_error); 
		die("Connection failed"); 
	} 
?>