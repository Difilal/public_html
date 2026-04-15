<?php 

//$browserjob=1;
//include("link-whatsapp-cronjob.php");

$mainDomain=str_replace("admin.","",domainname());
$sekolah=getdata("data_sekolah","domain='".$mainDomain."'");

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Worker Automation</title>
        <meta name="description" content="Sinkronisasi Data Absen, <?php echo $sekolah["nama_sekolah"]; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="900">


        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
		<!-- Optional JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/jcubic/jquery.rotate@0.4.0/jquery.rotate.js"></script>

		<!--<meta http-equiv="refresh" content="1">-->
		<script>
            var check_connectivity = {
                
                is_internet_connected: function() {
                    return $.get({
                        url: "/",
                        dataType: 'text',
                        cache: false
                    });
                },
                
            };


			function Worker_System(idangkatan,job)
            {
                var status_layanan=$("#idangkatan"+idangkatan).attr("status_layanan");
                if(status_layanan=="aktif")
                {
                    if(job=="OtomasiDataKalender"){           job="OtomasiDataAbsenSiswa"; }
                    else if(job=="OtomasiDataAbsenSiswa"){    job="RekapAbsen"; }
                    else if(job=="RekapAbsen"){               job="NotifOrtuSiswaTidakAbsen"; }
                    else if(job=="NotifOrtuSiswaTidakAbsen"){ job="KirimPesanAntarWaSender"; }
                    else if(job=="KirimPesanAntarWaSender"){  job="WaSenderBalancer"; }
                    else if(job=="WaSenderBalancer"){         job="OtomasiDataKalender"; }
                    else{                                     job="OtomasiDataKalender"; }
                
                    var linkurl="",timeout=0;
                    if(job=="RekapAbsen"){                    timeout=1200*1000; linkurl="link-rekap-absen-cronjob-";       }
                    else if(job=="OtomasiDataKalender"){      timeout=3800*1000; linkurl="link-otomasi-data-kalender-";     }
                    else if(job=="OtomasiDataAbsenSiswa"){    timeout=3500*1000; linkurl="link-otomasi-data-absen-siswa-";  }
                    else if(job=="WaSenderBalancer"){         timeout=600*1000;  linkurl="link-wa-sender-balancer-";         }
                    else if(job=="NotifOrtuSiswaTidakAbsen"){ timeout=1800*1000; linkurl="link-notif-siswa-tidak-absen-";   }
                    else if(job=="KirimPesanAntarWaSender"){  timeout=900*1000;  linkurl="link-kirim-pesan-antar-wa-sender-";}
                    else{ timeout=9000*1000; linkurl="link-broken-"; }
                
                    $("#"+job+idangkatan).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
                    $.post( linkurl+idangkatan+".html", { idangkatan:idangkatan },
                    function(data)
                    { //alert(data.idlogwa);
                        //var data=JSON.parse(data);
                        $("#"+job+idangkatan).html( 'idle' );
                        //setTimeout(function(){ Worker_System(idangkatan,job); }, timeout);
                        setTimeout(function(){ Worker_System(idangkatan,job); }, 3000);
                    }
                    )
                    .fail(function()
                    { 
                        $("#"+job+idangkatan).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
                        setTimeout(function(){ Worker_System(idangkatan,job); }, 10000);
                        //alert('WA Worker '+idangkatan+' : Error'); 
                    });
                }
			}	


			function Worker_Absen(idmesin)
            {
                var status_layanan=$("#idmesin"+idmesin).attr("status_layanan");
                if(status_layanan=="aktif")
                {
                    $("#worker_absen"+idmesin).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
                    $.post( "link-absen-cronjob-"+idmesin+".html", { idmesin:idmesin },
                    function(data)
                    { //alert(data.idlogwa);
                        var data=JSON.parse(data);
                        $("#worker_absen"+idmesin).html( 'idle' );
                        setTimeout(function(){ Worker_Absen(idmesin); }, 3000);
                    }
                    )
                    .fail(function()
                    { 
                        $("#worker_absen"+idmesin).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
                        setTimeout(function(){ Worker_Absen(idmesin); }, 10000);
                        //alert('WA Worker '+idmesin+' : Error'); 
                    });
                }
			}


			function Worker_Absen_Adms(idmesin,url_adms)
            {
                var status_layanan=$("#idmesin"+idmesin).attr("status_layanan");
                if(status_layanan=="aktif")
                {
                    /*$("#worker_absen"+idmesin+"_adms").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
                    $.post( url_adms, { idmesin:idmesin },
                    function(data)
                    { //alert(data.idlogwa);
                        var data=JSON.parse(data);
                        $("#worker_absen"+idmesin+"_adms").html( 'idle' );
                        setTimeout(function(){ Worker_Absen_Adms(idmesin,url_adms); }, 3000);
                    }
                    )
                    .fail(function()
                    { 
                        $("#worker_absen"+idmesin+"_adms").html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
                        setTimeout(function(){ Worker_Absen(idmesin); }, 10000);
                        //alert('WA Worker '+idmesin+' : Error'); 
                    });*/
                    
                    
                    
                    $("#worker_absen"+idmesin+"_adms").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
                    $.ajax({

                        url: url_adms,
                        data: { "ajax":"yes" },
                        type: 'GET',
                        crossDomain: true,
                        dataType: 'jsonp',
                        success: function()
                        { 
                            var data=JSON.parse(data);
                            $("#worker_absen"+idmesin+"_adms").html( 'idle' );
                            setTimeout(function(){ Worker_Absen_Adms(idmesin,url_adms); }, 3000);
                        },
                        error: function() 
                        { 
                            $("#worker_absen"+idmesin+"_adms").html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
                            setTimeout(function(){ Worker_Absen(idmesin); }, 10000);
                        }
                        //, beforeSend: setHeader
                    });
                    
                    
                }
			}	


			function Worker_WA(idwa)
            {
                var status_layanan=$("#idwa"+idwa).attr("status_layanan");
                if(status_layanan=="aktif")
                {
                    $("#worker_wa"+idwa).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
                    $.post( "link-whatsapp-cronjob-"+idwa+".html", { idwa:idwa },
                    function(data)
                    { //alert(data.idlogwa);
                        var data=JSON.parse(data);
                        $("#worker_wa"+idwa).html( 'idle' );
                        setTimeout(function(){ Worker_WA(idwa); }, 3000);
                    }
                    )
                    .fail(function()
                    { 
                        $("#worker_wa"+idwa).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
                        setTimeout(function(){ Worker_WA(idwa); }, 10000);
                        //alert('WA Worker '+idwa+' : Error'); 
                    });
                }
			}			
			
			function AnimateRotate(angle,repeat) {
				var duration= 1000;
				setTimeout(function() {
					if(repeat && repeat == "infinite") { AnimateRotate(angle,repeat); }
					else if ( repeat && repeat > 1) { AnimateRotate(angle, repeat-1); }
				},duration);
				var $elem = $('.icon-repeat');
				$({deg: 0}).animate({deg: angle}, { duration: duration, step: function(now){ $elem.css({ 'transform': 'rotate('+ now +'deg)' }); }});
			}
			AnimateRotate(360,"infinite");
		</script>
		<link rel="shortcut icon" href="cron-icon.png" type="image/png">
        <style>
            .c-table__cell,.c-table__head--slim .c-table__cell{padding: 10px 0px 10px 15px;}
            .sup-prog-data{ color:white;background-color:#999999;padding:1px 3px;border-radius:5px;font-size: 9px;font-weight: normal; }
        </style>
    </head>
    <body class="o-page " id="body" logdata="">

        <div class="o-page__card u-width-100">
            <div class="c-card u-m-xsmallz">
                <header class="c-card__header u-p-small">
                    <!--<span class="c-card__icon" style="background: #030B5E;">
                        <i class="u-h2 fas fa-sync-alt icon-repeat" id="icox"></i>
                    </span>-->
                    <div class="u-h3 u-text-center u-m-zero" style="line-height: 1;">WORKER AUTOMATION</div>
                    <div class="d-block u-text-center"><?php echo $sekolah["nama_sekolah"]; ?></div>
                </header>

                <div class="c-card__body">
                    <h2 class="u-h5 u-text-center u-text-bold"></h2>
                    <!--<h3 class="u-h5 u-text-center" style="color: limegreen;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>-->


                <?php 
                $qry="SELECT * FROM data_angkatan WHERE idsekolah='".escStringDB($sekolah["idsekolah"])."'";
                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                $jumlahSiswa=cekData("data_konsumen","idsekolah='".escStringDB($sekolah["idsekolah"])."'");
                $jumlahSiswaAktif=cekData("data_konsumen","idsekolah='".escStringDB($sekolah["idsekolah"])."' AND status_layanan='aktif'");
                $jumlahSiswaNonaktif=cekData("data_konsumen","idsekolah='".escStringDB($sekolah["idsekolah"])."' AND status_layanan='nonaktif'");
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
                                                        <div class="col-12 u-pr-zero">
                                                            <div class="row">
                                                                <div class="col u-ph-zero">
                                                                    <h3 class="u-m-zero">Data Angkatan</h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col u-ph-zero"><?php
                                                                    echo "Jumlah Siswa : ".NumberFormat($jumlahSiswa); 
                                                                    echo '&nbsp;';
                                                                    echo '<i class="fas fa-check-circle" style="color: green"></i> '.NumberFormat($jumlahSiswaAktif);
                                                                    echo ' <i class="fas fa-times-circle" style="color: #E80003"></i> '.NumberFormat($jumlahSiswaNonaktif);
                                                                ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </thead>
                                        </table>



                                    </th>
                                </tr>
                                <tr class="c-table__row">
                                  <th class="c-table__cell c-table__cell--head" width="100">Tahun Masuk</th>
                                  <th class="c-table__cell c-table__cell--head">Fungsi</th>
                                  <th class="c-table__cell c-table__cell--head">Progres</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php while($mfa=mysqli_fetch_array($mqr)){ 
                                    $status_aktif=cekData("data_konsumen","idangkatan='".$mfa["idangkatan"]."' AND status_layanan='aktif'");
                                    $status_nonaktif=cekData("data_konsumen","idangkatan='".$mfa["idangkatan"]."' AND status_layanan='nonaktif'");
                                    
                                    if($mfa["status_layanan"]=="aktif"){ $thnMasuk='<i class="fa fa-check u-color-success u-mr-xsmall"></i>'; }
                                    elseif($mfa["status_layanan"]=="nonaktif"){ $thnMasuk='<i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>'; }
                                    $thnMasuk.=" ".$mfa["tahun_masuk"];
    
                                    if(!isset($idangkatan_worker))  $idangkatan_worker=array($mfa["idangkatan"]);
                                    else                            array_push($idangkatan_worker,$mfa["idangkatan"]);
    
                                ?>
                                <tr class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                    <td class="c-table__cell "><?php echo $thnMasuk; ?></td>
                                    <td class="c-table__cell">Otomasi Data Kalender</td>
                                    <td class="c-table__cell" id="OtomasiDataKalender<?php echo $mfa["idangkatan"]; ?>">idle</td>
                                </tr>
                                <tr class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                    <td class="c-table__cell "><?php echo $thnMasuk; ?></td>
                                    <td class="c-table__cell">Otomasi Data Absen Siswa</td>
                                    <td class="c-table__cell" id="OtomasiDataAbsenSiswa<?php echo $mfa["idangkatan"]; ?>">idle</td>
                                </tr>
                                <tr id="idangkatan<?php echo $mfa["idangkatan"]; ?>" class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>" status_layanan="<?php echo $mfa["status_layanan"]; ?>">
                                    <td class="c-table__cell "><?php echo $thnMasuk; ?></td>
                                    <td class="c-table__cell">Rekap Absen</td>
                                    <td class="c-table__cell" id="RekapAbsen<?php echo $mfa["idangkatan"]; ?>">idle</td>
                                </tr>
                                <tr class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                    <td class="c-table__cell "><?php echo $thnMasuk; ?></td>
                                    <td class="c-table__cell">Notif Ortu Siswa Tidak Absen</td>
                                    <td class="c-table__cell" id="NotifOrtuSiswaTidakAbsen<?php echo $mfa["idangkatan"]; ?>">idle</td>
                                </tr>
                                <tr class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                    <td class="c-table__cell "><?php echo $thnMasuk; ?></td>
                                    <td class="c-table__cell">Kirim Pesan Antar WA Sender</td>
                                    <td class="c-table__cell" id="KirimPesanAntarWaSender<?php echo $mfa["idangkatan"]; ?>">idle</td>
                                </tr>
                                <tr class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                    <td class="c-table__cell "><?php echo $thnMasuk; ?></td>
                                    <td class="c-table__cell">WA Sender Balancer</td>
                                    <td class="c-table__cell" id="WaSenderBalancer<?php echo $mfa["idangkatan"]; ?>">idle</td>
                                </tr>
                                
                                <?php } ?>
                            </tbody>
                            
                            
                        </table>
                        </div>

                    </div>
                </div>

			
                <?php
                $qry="SELECT * FROM data_absensi_mesin WHERE idsekolah='".escStringDB($sekolah["idsekolah"])."'";
                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                $JumlahMesin=mysqli_num_rows($mqr);
                ?>
                <div class="row u-mb-large" style="margin-top: 20px;">
                    <div class="col-sm-12">

                        <div class="c-table-responsive@desktop">	
                        <table class="c-table c-table--highlight">



                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th colspan="6" class="c-table__cell c-table__cell--head u-p-small">   

                                        <table width="100%" data-classes="table">
                                            <thead class="c-table__head c-table__head--slim">
                                            <tr>
                                                <td>
                                                    <div class="row u-pl-small">
                                                        <div class="col-12 u-pr-zero">
                                                            <div class="row">
                                                                <div class="col u-ph-zero">
                                                                    <h3 class="u-m-zero">Data Mesin Absensi</h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col u-ph-zero"><?php
                                                                    echo "Jumlah : ".NumberFormat($JumlahMesin); 
                                                                ?></div>
                                                            </div>
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
                                  <th class="c-table__cell c-table__cell--head">Hosting</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                $dataSumScan=$dataSumSupScan=0;
                                while($mfa=mysqli_fetch_array($mqr)){ 
                                $angkatan=GetData("data_angkatan","idangkatan='".escStringDB($mfa["idangkatan"])."'");
                                    
                                    if(	substr($_SERVER['HTTP_HOST'],-15)=="smpn1sumber.com")       $url="https://pintarsekolah.irwan.id:8910/api-sync-smpn1sumber-SerialNumber.html";
                                    elseif(	substr($_SERVER['HTTP_HOST'],-15)=="sman1sumber.com")   $url="https://pintarsekolah.irwan.id:8910/api-sync-sman1sumber-SerialNumber.html";
                                    else                                                            $url="https://pintarsekolah.irwan.id:8910/SerialNumber.html";
                                    
                                    if(	substr($_SERVER['HTTP_HOST'],-15)=="smpn1sumber.com")       $url="https://www.google.com/";
                                    elseif(	substr($_SERVER['HTTP_HOST'],-15)=="sman1sumber.com")   $url="https://www.google.com/";
                                    else                                                            $url="https://www.google.com/";
                                    
                                    if(!isset($idmesin_worker))
                                    {
                                        $idmesin_worker=array($mfa["idmesin"]);
                                        $url_mesin_worker=array(str_replace("SerialNumber",$mfa["serial_number"],$url));
                                    }
                                    else
                                    {
                                        array_push($idmesin_worker,$mfa["idmesin"]);
                                        array_push($url_mesin_worker,str_replace("SerialNumber",$mfa["serial_number"],$url));
                                    }
                                    
                                ?>
                                <tr id="idmesin<?php echo $mfa["idmesin"]; ?>" class="c-table__row" status_layanan="aktif">
                                    <td class="c-table__cell">
                                        <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["serial_number"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
                                        <?php echo $mfa["serial_number"]; ?>
                                        </span>
                                        <small class="d-block u-text-mute"><?php //echo $mfa["kota"].", ".$mfa["provinsi"]; ?></small>
                                    </td>

                                    <td class="c-table__cell"><?php echo $angkatan["tahun_masuk"]; ?>
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

                                    <td class="c-table__cell u-text-right" id="worker_absen<?php echo $mfa["idmesin"]; ?>_adms">idle</td>
                                    <td class="c-table__cell u-text-right" id="worker_absen<?php echo $mfa["idmesin"]; ?>">idle</td>
                                </tr>
                                <?php } ?>
                            </tbody>

                            <thead class="c-table__head c-table__head--slim">
                                <tr id="idmesin<?php echo $mfa["idmesin"]; ?>" class="c-table__row">
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

                                    <th class="c-table__cell u-text-right" colspan="2">
                                    </th>
                                </tr>
                            </thead>
                            
                            
                        </table>
                        </div>

                    </div>
                </div>
                    
                    
                <?php
                $qry="SELECT * FROM data_nohp_wa WHERE idsekolah='".escStringDB($sekolah["idsekolah"])."'";
                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                $JumlahNohpWa=mysqli_num_rows($mqr);
                ?>
                <div class="row u-mb-large" style="margin-top: 20px;">
                    <div class="col-sm-12">

                        <div class="c-table-responsive@desktop">	
                        <table class="c-table c-table--highlight">



                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th colspan="9" class="c-table__cell c-table__cell--head u-p-small">                                 


                                        <table width="100%" data-classes="table">
                                            <thead class="c-table__head c-table__head--slim">
                                            <tr>
                                                <td>
                                                    <div class="row u-pl-small">
                                                        <div class="col-12 u-pr-zero">
                                                            <div class="row">
                                                                <div class="col u-ph-zero">
                                                                    <h3 class="u-m-zero">Data Nohp Whatsapp</h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col u-ph-zero"><?php
                                                                    echo "Jumlah : ".NumberFormat($JumlahNohpWa); 
                                                                ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </thead>
                                        </table>


                                    </th>
                                </tr>
                                <tr class="c-table__row">
                                  <th class="c-table__cell c-table__cell--head">Nohp Whatsapp</th>
                                  <th class="c-table__cell c-table__cell--head">Tahun Masuk</th>
                                  <th class="c-table__cell c-table__cell--head">Default Sender</th>
                                  <th class="c-table__cell c-table__cell--head">Data Queue</th>
                                  <th class="c-table__cell c-table__cell--head">Data Sent</th>
                                  <th class="c-table__cell c-table__cell--head">Data Received</th>
                                  <th class="c-table__cell c-table__cell--head">Worker Progress</th>
                                  <th class="c-table__cell c-table__cell--head">Status Layanan</th>
                                  <th class="c-table__cell c-table__cell--head">
                                      <span class="u-hidden-visually">Actions</span>
                                  </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
                                $dataSumQueue=$dataSumSent=$dataSumReceived=$dataSumSupQueue=$dataSumSupSent=$dataSumSupReceived=$DataWaSumDefaultSender=0;
                                while($mfa=mysqli_fetch_array($mqr)){ 
                                $angkatan=GetData("data_angkatan","idangkatan='".escStringDB($mfa["idangkatan"])."'");
                                    
                                    if(!isset($idwa_worker)) $idwa_worker=array($mfa["idwa"]);
                                    else                     array_push($idwa_worker,$mfa["idwa"]);
                                    
                                ?>
                                <tr id="idwa<?php echo $mfa["idwa"]; ?>" class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>" status_layanan="<?php echo $mfa["status_layanan"]; ?>">
                                    <td class="c-table__cell">
                                        <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["nohp_wa"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
                                        <?php echo $mfa["nohp_wa"]; ?>
                                        </span>
                                        <small class="d-block u-text-mute"><?php //echo $mfa["kota"].", ".$mfa["provinsi"]; ?></small>
                                    </td>

                                    <td class="c-table__cell"><?php echo $angkatan["tahun_masuk"]; ?>
                                        <small class="d-block u-text-mute"><?php //echo HitungHari($mfa["tgl_register"],date("Y-m-d H:i:s"))." Hari"; ?></small>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DefaultSender<?php echo $mfa["idwa"]; ?>"><?php 

                                        $cekTabelLogin=cekData("data_karyawan","last_wa_sender='".$mfa["nohp_wa"]."'");
                                        $cekTabelSiswa=cekData("data_konsumen","last_wa_sender='".$mfa["nohp_wa"]."'");
                                        //$cekTabelWlKls=cekData("data_wali_kelas","last_wa_sender='".$mfa["nohp_wa"]."'");
                                        echo $DefaulSender=$cekTabelLogin+$cekTabelSiswa;//+$cekTabelWlKls;
                                        $DataWaSumDefaultSender+=$DefaulSender;

                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaQueue<?php echo $mfa["idwa"]; ?>"><?php 
                                        $dataQueue=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='queue'");
                                        $dataSumQueue+=$dataQueue;
                                        echo NumberFormat($dataQueue); 
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSent<?php echo $mfa["idwa"]; ?>"><?php 
                                        $dataSent=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='sent'");
                                        $dataSumSent+=$dataSent;

                                        $dataSupSent=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='sent' AND waktu LIKE '".date("Y-m-d")."%'");
                                        $dataSumSupSent+=$dataSupSent;

                                        echo NumberFormat($dataSent);
                                        if($dataSupSent>0){
                                            echo ' <sup class="sup-prog-data">+';
                                            echo numberFormat($dataSupSent);
                                            echo "</sup>";   
                                        }
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaReceived<?php echo $mfa["idwa"]; ?>"><?php 
                                        $dataReceived=cekData("data_log_wa","nohp_tujuan='".$mfa["nohp_wa"]."' AND status_kirim='received'");
                                        $dataSumReceived+=$dataReceived;

                                        $dataSupReceived=cekData("data_log_wa","nohp_tujuan='".$mfa["nohp_wa"]."' AND status_kirim='received' AND waktu LIKE '".date("Y-m-d")."%'");
                                        $dataSumSupReceived+=$dataSupReceived;

                                        echo NumberFormat($dataReceived); 
                                        if($dataSupReceived>0){
                                            echo ' <sup class="sup-prog-data">+';
                                            echo numberFormat($dataSupReceived);
                                            echo "</sup>";   
                                        }
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaCronjob<?php echo $mfa["idwa"]; ?>"><?php 
                                            echo FormatDate($mfa["cronjob_last_operation"])." ".FormatWaktu($mfa["cronjob_last_operation"],"full");
                                            if($mfa["cronjob_operation"]>0){
                                                echo ' <sup class="sup-prog-data">';
                                                echo NumberFormat($mfa["cronjob_operation"]); 
                                                echo "</sup>";  
                                            }
                                        ?></span>
                                    </td>

                                    <td class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="StatusLayananWa<?php echo $mfa["idwa"]; ?>">
                                        <?php if($mfa["status_layanan"]=="aktif"){ ?>
                                        <i class="fa fa-check u-color-success u-mr-xsmall"></i>Aktif
                                        <?php }elseif($mfa["status_layanan"]=="nonaktif"){ ?>
                                        <i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Nonaktif
                                        <?php } ?>
                                        </span>
                                    </td>

                                    <td class="c-table__cell u-text-right" id="worker_wa<?php echo $mfa["idwa"]; ?>"><?php
                                    
                                    if($mfa["status_layanan"]=="aktif") echo "idle";
                                    else echo '<i class="fas fa-times u-color-danger"></i>';
                                    
                                    ?></td>
                                </tr>
                                <?php } ?>

                            </tbody>

                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell" colspan="2">Jumlah Data</th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumDefaultSender"><?php 
                                            echo NumberFormat($DataWaSumDefaultSender); 
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumQueue"><?php 
                                            echo NumberFormat($dataSumQueue); 
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumSent"><?php 
                                            echo NumberFormat($dataSumSent); 
                                            if($dataSumSupSent>0){
                                                echo ' <sup class="sup-prog-data">+';
                                                echo numberFormat($dataSumSupSent);
                                                echo "</sup>";   
                                            }
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell">
                                        <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumReceived"><?php 
                                            echo NumberFormat($dataSumReceived); 
                                            if($dataSumSupReceived>0){
                                                echo ' <sup class="sup-prog-data">+';
                                                echo numberFormat($dataSumSupReceived);
                                                echo "</sup>";   
                                            }
                                        ?></span>
                                    </th>
                                    <th class="c-table__cell c-table__cell--head"></th>
                                    <th class="c-table__cell c-table__cell--head"></th>
                                    <th class="c-table__cell c-table__cell--head">
                                      <span class="u-hidden-visually">Actions</span>
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

<script>$(document).ready(function(){
<?php 
        
    if(isset($idangkatan_worker))
    {
        for($i=0;$i<count($idangkatan_worker);$i++)
        { 
            /*echo 'Worker_System('.$idangkatan_worker[$i].',"RekapAbsen");'; 
            echo 'Worker_System('.$idangkatan_worker[$i].',"OtomasiDataKalender");'; 
            echo 'Worker_System('.$idangkatan_worker[$i].',"OtomasiDataAbsenSiswa");'; 
            echo 'Worker_System('.$idangkatan_worker[$i].',"WaSenderBalancer");'; 
            echo 'Worker_System('.$idangkatan_worker[$i].',"NotifOrtuSiswaTidakAbsen");'; */
            echo 'Worker_System('.$idangkatan_worker[$i].',"KirimPesanAntarWaSender");';
        }
    }
    if(isset($idmesin_worker)){
        for($i=0;$i<count($idmesin_worker);$i++)
        { 
            echo 'Worker_Absen('.$idmesin_worker[$i].');'; 
            echo 'Worker_Absen_Adms('.$idmesin_worker[$i].',"'.$url_mesin_worker[$i].'");'; 
        }
    } 
    if(isset($idwa_worker)) for($i=0;$i<count($idwa_worker);$i++){ echo 'Worker_WA('.$idwa_worker[$i].');'; }
        
?>
});
</script>
        
    </body>
</html>