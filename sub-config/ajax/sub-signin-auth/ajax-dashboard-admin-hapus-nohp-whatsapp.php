<?php sleep(1);

	$idwa = $_POST["idwa"];
    $dataWa = getData("data_nohp_wa","idwa='".$idwa."'");

    if($dataWa["status_layanan"]=="aktif") $status="Nonaktifkan layanan terlebih dahulu";
    elseif($dataWa["status_layanan"]=="nonaktif"){
        $qry ="DELETE FROM data_nohp_wa WHERE idwa='".escStringDB($idwa)."' LIMIT 1";
        if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){ $status=1; }
        else $status="Response Failed";//.mysqli_error($_SESSION["sess"]["koneksi"]);   
    }else $status="Status layanan : ".$dataWa["status_layanan"];

	if(isset($status)) echo $status;