<?php sleep(1);

	$iduser = $_POST["iduser"];
	$qry ="DELETE FROM data_karyawan WHERE iduser='".escStringDB($iduser)."' LIMIT 1";

	if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){ $status=1; }
	else $status="Response Failed";//.mysqli_error($_SESSION["sess"]["koneksi"]);

	if(isset($status)) echo $status;