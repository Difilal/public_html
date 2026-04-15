<?php sleep(1);

	$idwa		= $_POST["idwa"];
	$nohp_wa	= $_POST["nohp_wa"];
	$api_key	= $_POST["api_key"];
	$vendor_wa	= $_POST["vendor_wa"];

	$cekNohpWa		= cekData("data_nohp_wa","nohp_wa='".escStringDB($nohp_wa)."' AND idwa!='".escStringDB($idwa)."'");

	if($nohp_wa=="") 		$status["nohp_wa"]="Nohp whatsapp harus diisi";
	else if($cekNohpWa>0) 	$status["nohp_wa"]="Nohp whatsapp duplikat";
	if($api_key=="") 		$status["api_key"]="API key harus diisi";
	if($vendor_wa=="") 		$status["vendor_wa"]="API key harus diisi";
	
	if(!isset($status))
	{
		$qry	="UPDATE data_nohp_wa SET 	nohp_wa='".escStringDB( $nohp_wa)."',
											api_key='".escStringDB( $api_key)."',
											vendor='".escStringDB( $vendor_wa)."'
											WHERE idwa='".escStringDB($idwa)."'";
		
		if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){
			$status["respon"]="success";
		}
		else $status["respon"]="Response Failed";//.mysqli_error($_SESSION["sess"]["koneksi"]);
	}

	echo json_encode($status);