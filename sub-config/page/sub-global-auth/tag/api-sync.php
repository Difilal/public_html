<?php if(!isset($_POST["data_mesin_absen"]) || !is_array($_POST["data_mesin_absen"])) exit;


$data_mesin_absen=$_POST["data_mesin_absen"];
$status["respon"]=array();
foreach($data_mesin_absen AS $key=>$val)
{
    if(isset($val["serial_number"]))
    {
        $_GET["SN"]     = $val["serial_number"];
        $_GET["vendor"] = $val["vendor"];

        include("api-sync-sub.php");
    }
}



// include("link-mysql-hosting-server.php");
$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["default"];
$SN     = array();
$qry    = "SELECT * FROM data_absensi_mesin";
$mqr    = mysqli_query($_SESSION["sess"]["koneksi"],$qry);
while($mfa=mysqli_fetch_array($mqr)){ array_push($SN,$val["serial_number"]); }
$SN     = "'".join("','",$SN)."'";


// include("link-mysql-adms-server.php");
$_SESSION["sess"]["koneksi"]=$_SESSION["sess"]["condb"]["adms"];
$data_mesin_absen=array();
$qry="SELECT DISTINCT SN FROM checkinout WHERE SN IN ($SN)";
$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
while($mfa=mysqli_fetch_array($mqr))
{
    $abc=array( "vendor"=>"tag",
                "serial_number"=>$mfa["SN"],
                "status_layanan"=>"aktif");
    array_push($data_mesin_absen,$abc);
}

$status["dataMesinWorking"]=$data_mesin_absen;
echo json_encode($status);