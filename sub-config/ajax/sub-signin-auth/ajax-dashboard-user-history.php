<?php

if(isset($_POST["HistoryDate"]))
{
	//include("ajax-app-security.php"); sleep(0);	
	$_SESSION["sess"]["HistoryActivity"]["Date"]=$_POST["HistoryDate"];
	//echo $_SESSION["sess"]["HistoryActivity"]["Date"];
}