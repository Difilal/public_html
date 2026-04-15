<?php sleep(1);

	$idwa	        = $_POST["idwa"];
	$statuslayanan	= $_POST["statuslayanan"];
    $cekWa          = cekData("data_nohp_wa","idwa='".$idwa."'");
    $dataWa         = getData("data_nohp_wa","idwa='".$idwa."'");
	
	if($statuslayanan=='nonaktif') $status="aktif"; else $status="nonaktif";
	if($cekWa==0) $status="Data whatsapp tidak valid";
	else
	{
		$qry ="UPDATE data_nohp_wa SET status_layanan='".$status."' WHERE idwa='".$idwa."'";
		if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){ 
            $status=1; 
            if($statuslayanan=='aktif'){
                $qry="SELECT * FROM data_log_wa WHERE status_kirim='queue' AND nohp_pengirim='".$dataWa["nohp_wa"]."'";
                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                while($mfa=mysqli_fetch_array($mqr)){
                    $nohp_pengirim=getNohpWaSender($dataWa["idangkatan"]);
                    if($nohp_pengirim!=""){
                        $qry2="UPDATE data_log_wa SET nohp_pengirim='".$nohp_pengirim."' WHERE idlogwa='".$mfa["idlogwa"]."'";   
                        runQuery($qry2);
                    }
                }
            }
        }
		else $status="Response Failed";//.mysqli_error($_SESSION["sess"]["koneksi"]);
	}

	if(isset($status)) echo $status;