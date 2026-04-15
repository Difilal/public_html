<?php

$browserjob=1;
include("link-absen-cronjob.php");

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sinkronisasi Data Absen</title>
        <meta name="description" content="Sinkronisasi Data Absen, <?php echo $sekolah["nama_sekolah"].", Tahun Masuk ".$angkatan["tahun_masuk"]; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
			function LinkOtomasi(idmesin){
					$.post( "link-absen-cronjob-"+idmesin+".html", { idmesin:idmesin },
					function(data){ //alert(data);
						var data=JSON.parse(data);
						if(data.kirim_notifikasi==="Ya") var color_notif="blue"; else var color_notif="red";
						var a='<tr class="c-table__row">';
						a+='<td class="c-table__cell">'+data.nisn+'</td>';
						a+='<td class="c-table__cell">'+data.nama_siswa+'</td>';
						a+='<td class="c-table__cell">'+data.tgl_absen+'</td>';
						a+='<td class="c-table__cell">'+data.jam_absen+'</td>';
						a+='<td class="c-table__cell"><span style="color:'+color_notif+'">'+data.kirim_notifikasi+'</span></td>';
						a+='</tr>';
						if(data.idabsensi!==undefined) $("#data_sinkron").prepend(a);
						
						var lstr='<i class="fas fa-angle-double-left"></i>';
						var str='<i class="fas fa-minus"></i>';
						var rstr='<i class="fas fa-angle-double-right"></i>';
						if( $("#progress_data").html()===lstr+str.repeat(1)+rstr) $("#progress_data").html(lstr+str.repeat(3)+rstr);
						else if( $("#progress_data").html()===lstr+str.repeat(3)+rstr) $("#progress_data").html(lstr+str.repeat(5)+rstr);
						else if( $("#progress_data").html()===lstr+str.repeat(5)+rstr) $("#progress_data").html(lstr+str.repeat(7)+rstr);
						else if( $("#progress_data").html()===lstr+str.repeat(7)+rstr) $("#progress_data").html(lstr+str.repeat(9)+rstr);
						else if( $("#progress_data").html()===lstr+str.repeat(9)+rstr) $("#progress_data").html(lstr+str.repeat(11)+rstr);
						else if( $("#progress_data").html()===lstr+str.repeat(11)+rstr) $("#progress_data").html(lstr+str.repeat(13)+rstr);
						else $("#progress_data").html(lstr+str.repeat(1)+rstr);
						setTimeout(function(){ LinkOtomasi(idmesin); }, 500);
					}
					).fail(function(){ consol.log('Response Failed'); });
			}			
			setTimeout(function(){ LinkOtomasi(<?php echo $_GET["idmesin"]; ?>); }, 2000);
			
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
		<link rel="shortcut icon" href="/sync-icon.png" type="image/png">
    </head>
    <body class="o-page o-page--center">

        <div class="o-page__card u-width-75">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-pt-large">
                    <span class="c-card__icon">
                        <i class="u-h2 fas fa-sync-alt icon-repeat" id="icox"></i>
                    </span>
                    <h1 class="u-h3 u-text-center u-mb-zero">Sinkronisasi Data Absen</h1>
                </header>

                <div class="c-card__body">
                    <h2 class="u-h5 u-text-center u-text-bold"><?php echo $sekolah["nama_sekolah"]; ?></h2>
                    <h2 class="u-h5 u-text-center"><?php echo "Tahun Masuk ".$angkatan["tahun_masuk"]; ?></h2>
                    <h2 class="u-h5 u-text-center"><?php echo "SN Mesin Absen : ".$mesin["serial_number"]; ?></h2>
                    <h3 class="u-h5 u-text-center" style="color: blue;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>

					<table class="c-table">
						<thead class="c-table__head c-table__head--slim">
							<tr class="c-table__row">
								<th class="c-table__cell c-table__cell--head">NISN</th>
								<th class="c-table__cell c-table__cell--head">Nama Siswa</th>
								<th class="c-table__cell c-table__cell--head">Tgl. Absen</th>
								<th class="c-table__cell c-table__cell--head">Jam Absen</th>
								<th class="c-table__cell c-table__cell--head">Kirim Notifikasi</th>
							</tr>
						</thead>
						<tbody id="data_sinkron"></tbody>
					</table>
				</div>
                
            </div>

            <div class="o-line u-justify-center">
                <a class="u-text-mute" href="#">
                    <?php echo siteURL(); ?>
                </a>
            </div>
        </div>
    </body>
</html>