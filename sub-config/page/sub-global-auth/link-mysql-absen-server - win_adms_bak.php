<?php
	$dbhost	= "localhost";
	$dbuser	= "root";
	$dbpass	= "";
	$dbname	= "adms_db";
	$mysql_port=83306;
	$_SESSION["sess"]["koneksi"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);

	// Create connection
	$_SESSION["sess"]["connect"] = new mysqli($dbhost,$dbuser,$dbpass,$dbname,$mysql_port); 
	// Check connection
	if ($_SESSION["sess"]["connect"]->connect_error) { //die("Connection failed: " . $_SESSION["sess"]["connect"]->connect_error); 
		die("Connection failed"); 
	}
?>