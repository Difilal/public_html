<?php //echo domainname(); exit;

include("link-mysql-hosting-server.php");

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Absensi Sync</title>
        <meta name="description" content="Sinkronisasi Data Absen, <?php  ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="300">


        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
		<!-- Optional JavaScript -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/jcubic/jquery.rotate@0.4.0/jquery.rotate.js"></script> -->


        <!-- Optional JavaScript, jQuery first, then Popper.js, then Bootstrap JS -->
        <?php if($_SESSION["sess"]["online"]==1){ ?>
            <!-- <script src="<?php echo siteURL(); ?>js-defer.js"></script> -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <?php }else{ ?>
            <script src="<?php echo siteURL(); ?>js-jquery-3.5.1.min.js"></script>
            <!-- <script src="<?php echo siteURL(); ?>js-jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
            <script src="<?php echo siteURL(); ?>js-jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
            <script src="<?php echo siteURL(); ?>js-popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="<?php echo siteURL(); ?>css-bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="<?php echo siteURL(); ?>js-bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <?php } ?>
		
        <?php

        $dir="js/";
        $jsf=listFile($dir,"js");
        $lastUpdateFile=0;
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }

        $dir="js/autoload/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }

        /* $dir="sub-config/js/js-global-auth/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){ 
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        } */

        if($_GET["pg"]=="otomasi" && isset($_GET["vendor"]))
        {
            $dir="sub-config/page/sub-global-auth/".$_GET["vendor"]."/";
            $filename=$_GET["subpg"].".js";
            $cekLastUpdateFile=date("ymdHis", filemtime($dir.$filename));
            if($lastUpdateFile<$cekLastUpdateFile){ $lastUpdateFile=$cekLastUpdateFile; }
        }

        if($lastUpdateFile==0) $lastUpdateFile=date("ymdh");
        $jsVersion=$lastUpdateFile;


        ?><script type="text/javascript" src="<?php echo siteURL().$lastUpdateFile."-main-script-".$_SESSION["sess"]["subpg"].".js"; ?>"></script>
		<link rel="shortcut icon" href="sync-icon.png" type="image/png">
        <style>
            .c-table__cell,.c-table__head--slim .c-table__cell{padding: 10px 0px 10px 15px;}
            .sup-prog-data{ color:white;background-color:#999999;padding:1px 3px;border-radius:5px;font-size: 9px;font-weight: normal; }
        </style>
    </head>
    <body class="o-page " id="body" logdata="">

        <div class="o-page__card u-width-100">
            <div class="c-card u-m-xsmallz">
                <header class="c-card__header u-p-small">
                    <!--
                        <span class="c-card__icon" style="background: #030B5E;">
                            <i class="u-h2 fas fa-sync-alt icon-repeat" id="icox"></i>
                        </span>
                    -->
                    <div class="u-h3 u-text-center u-m-zero" style="line-height: 1;">ABSENSI SYNC</div>
                    <div class="d-block u-text-center"><?php  ?></div>
                </header>

                <div class="c-card__body">
                    <h2 class="u-h5 u-text-center u-text-bold"></h2>
                    <!--<h3 class="u-h5 u-text-center" style="color: limegreen;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>-->


			
                <?php
                $qry="SELECT * FROM data_absensi_mesin";
                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                $JumlahMesin=mysqli_num_rows($mqr);
                ?>
                <div class="row u-mb-large" style="margin-top: 20px;">
                    <div class="col-sm-12">

                        <div class="c-table-responsive@desktop">	
                        <table class="c-table c-table--highlight">



                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th colspan="5" class="c-table__cell c-table__cell--head u-p-small">   

                                        <table width="100%" data-classes="table">
                                            <thead class="c-table__head c-table__head--slim">
                                            <tr>
                                                <td>
                                                    <div class="row u-pl-small">
                                                        <div class="col-8 u-pr-zero">
                                                            <div class="row">
                                                                <div class="col u-ph-zero">
                                                                    <h3 class="u-m-zero">Data Mesin Absensi</h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col u-ph-zero"><?php
                                                                    echo "Jumlah : ".NumberFormat($JumlahMesin); 
                                                                ?>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 u-pr-xsmall u-text-right">
                                                            
                                                        </div>
                                                        <div class="col-2 u-pr-xsmall u-text-right">
                                                            <span id="progresApiSyncMesinAbsen"><img src="img-check.png"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </thead>
                                        </table>


                                    </th>
                                </tr>
                                <tr class="c-table__row">
                                  <th class="c-table__cell c-table__cell--head">Serial Number</th>
                                  <th class="c-table__cell c-table__cell--head">Tahun Masuk</th>
                                  <th class="c-table__cell c-table__cell--head">Jumlah Data</th>
                                  <th class="c-table__cell c-table__cell--head">Worker Progress</th>
                                  <th class="c-table__cell c-table__cell--head">Adms</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                $dataSumScan=$dataSumSupScan=0;
                                $data_mesin_absen=array();
                                while($mfa=mysqli_fetch_array($mqr))
                                { 
                                    $angkatan=GetData("data_cabang","idperusahaan!='-1'");
                                    
                                    $url  = "./api-sync-VENDOR-SerialNumber.html";
                                    $url2 = str_replace("SerialNumber",$mfa["serial_number"],$url);
                                    $url2 = str_replace("VENDOR",$_GET["vendor"],$url2);

                                    $abc=array( "vendor"=>$_GET["vendor"],
                                                "serial_number"=>$mfa["serial_number"],
                                                "status_layanan"=>"aktif");
                                    array_push($data_mesin_absen,$abc);
                                    
                                    if(!isset($idmesin_worker))
                                    {
                                        $idmesin_worker=array($mfa["idmesin"]);
                                        $url_mesin_worker=array($url2);
                                    }
                                    else
                                    {
                                        array_push($idmesin_worker,$mfa["idmesin"]);
                                        array_push($url_mesin_worker,$url2);
                                    }
                                    
                                ?>
                                <tr id="idmesin<?php echo $mfa["idmesin"]; ?>" class="c-table__row" status_layanan="aktif">
                                    <td class="c-table__cell">
                                        <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["serial_number"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
                                        <?php echo $mfa["serial_number"]; ?>
                                        </span>
                                        <small class="d-block u-text-mute"><?php //echo $mfa["kota"].", ".$mfa["provinsi"]; ?></small>
                                    </td>

                                    <td class="c-table__cell"><?php //echo $angkatan["tahun_masuk"]; ?>
                                        <small class="d-block u-text-mute"><?php //echo HitungHari($mfa["tgl_register"],date("Y-m-d H:i:s"))." Hari"; ?></small>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataAbsenRecord<?php echo $mfa["idmesin"]; ?>"><?php 

                                            $dataScan=cekData("data_absensi","sn_mesin_absensi='".$mfa["serial_number"]."'");
                                            $dataSumScan+=$dataScan;

                                            $dataSupScan=cekData("data_absensi","sn_mesin_absensi='".$mfa["serial_number"]."' AND waktu_absen LIKE '".date("Y-m-d")."%'");
                                            $dataSumSupScan+=$dataSupScan;

                                            echo NumberFormat($dataScan);
                                            if($dataSupScan>0){
                                                echo ' <sup class="sup-prog-data">+';
                                                echo numberFormat($dataSupScan);
                                                echo "</sup>";   
                                            }
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataAbsenCronjob<?php echo $mfa["idmesin"]; ?>"><?php 
                                        echo FormatDate($mfa["cronjob_last_operation"])." ".FormatWaktu($mfa["cronjob_last_operation"],"full");
                                        if($mfa["cronjob_operation"]>0){
                                            echo ' <sup class="sup-prog-data">';
                                            echo NumberFormat($mfa["cronjob_operation"]);
                                            echo "</sup>"; 
                                        }
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell u-text-left" id="worker_absen<?php echo $mfa["idmesin"]; ?>_adms">idle</td>
                                </tr>
                                <?php } ?>
                            </tbody>

                            <thead class="c-table__head c-table__head--slim">
                                <tr id="rowJumlahData_MesinAbsen" class="c-table__row">
                                    <th class="c-table__cell" colspan="2">
                                        <span>
                                            Jumlah Data
                                        </span>
                                    </th>

                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataAbsenSumRecord"><?php
                                            echo NumberFormat($dataSumScan);
                                            if($dataSumSupScan>0){
                                                echo ' <sup class="sup-prog-data">+';
                                                echo numberFormat($dataSumSupScan);
                                                echo "</sup>";   
                                            }
                                        ?></span>
                                    </th>

                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataAbsenCronjob">
                                        </span>
                                    </th>

                                    <th class="c-table__cell u-text-right">
                                    </th>
                                </tr>
                            </thead>
                            
                            
                        </table>
                        </div>

                    </div>
                </div>



                </div>

            </div>

            <div class="o-line u-justify-center">
                <a class="u-text-mute" href="#">
                    <?php echo siteURL(); ?>
                </a>
            </div>
        </div>

<?php

if(is_array($idmesin_worker))   $idmesin_worker=json_encode($idmesin_worker); else $idmesin_worker="";
if(is_array($url_mesin_worker)) $url_mesin_worker=json_encode($url_mesin_worker); else $url_mesin_worker="";
if(is_array($data_mesin_absen)) $data_mesin_absen=json_encode($data_mesin_absen); else $data_mesin_absen="";

?>

<!-- <div class="d-block d-none" id="idmesin_worker"><?php echo $idmesin_worker; ?></div>
<div class="d-block d-none" id="url_mesin_worker"><?php echo $url_mesin_worker; ?></div> -->
<div class="d-block d-none" id="data_mesin_absen"><?php echo $data_mesin_absen; ?></div>
        
    </body>
</html>