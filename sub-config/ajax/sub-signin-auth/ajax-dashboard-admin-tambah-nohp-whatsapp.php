<?php sleep(1);

	$nohp_wa	= $_POST["nohp_wa"];
	$api_key	= $_POST["api_key"];
	$vendor_wa	= $_POST["vendor_wa"];

	$cekNohpWa		= cekData("data_nohp_wa","nohp_wa='".escStringDB($nohp_wa)."'");

	if($nohp_wa=="") $status["nohp_wa"]="Nohp whatsapp harus diisi";
	else if($cekNohpWa>0) $status["nohp_wa"]="Nohp whatsapp telah teregistrasi sebelumnya";
	if($api_key=="") $status["api_key"]="API key harus diisi";
	
	if(!isset($status))
	{
		$qry	="INSERT INTO data_nohp_wa 	( nohp_wa,api_key,vendor,tgl_register)
				  VALUES				(	'".escStringDB( $nohp_wa)."',
											'".escStringDB( $api_key)."',
											'".escStringDB( $vendor_wa)."',
											'".date("Y-m-d H:i:s")."')";
		
		if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){
			$status["respon"]="success";
		}
		else $status["respon"]="Response Failed.";//.mysqli_error($_SESSION["sess"]["koneksi"]);
	}

	echo json_encode($status);