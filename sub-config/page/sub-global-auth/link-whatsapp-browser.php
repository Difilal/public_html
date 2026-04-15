<?php

$browserjob=1;
include("link-whatsapp-cronjob.php");

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Kirim Notifikasi Whatsapp</title>
        <meta name="description" content="Sinkronisasi Whatsapp Sender">
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
			function LinkOtomasi(idwa){
					$.post( "link-whatsapp-cronjob-"+idwa+".html", { idwa:idwa },
					function(data){ /* alert(data); */
						
						var logdata=$("body").attr("logdata");
						if(logdata==="") logdata=0; logdata=parseInt(logdata);
						
						var data=JSON.parse(data); /* alert(data.result); */

						if(data.GetMsgById_respon!==undefined) alert(data.GetMsgById_respon);
						
						if(logdata===0 || (logdata>0 && ($("#nohp_tujuan"+logdata).attr("md5")!==data.nohp_tujuan_md5 || 
														 $("#pesan"+logdata).attr("md5")!==data.pesan_md5 || 
														 $("#waktu"+logdata).attr("md5")!==data.waktu_md5 || 
														 $("#result"+logdata).attr("md5")!==data.result_md5	)) )
						{	logdata++; 
							var a='<tr class="c-table__row">';
							a+='<td class="c-table__cell" id="idlogwa'+logdata+'">'+data.idlogwa+'</td>';
							a+='<td class="c-table__cell" id="nohp_tujuan'+logdata+'" 	md5="'+data.nohp_tujuan_md5+'">'+data.nohp_tujuan+'</td>';
							a+='<td class="c-table__cell" id="pesan'+logdata+'" 		md5="'+data.pesan_md5+'" style="word-wrap: break-word;white-space:normal;">'+data.pesan+'</td>';
							a+='<td class="c-table__cell" id="waktu'+logdata+'" 		md5="'+data.waktu_md5+'" style="word-wrap: break-word;white-space:normal;">'+data.waktu+'</td>';
							a+='<td class="c-table__cell" id="result'+logdata+'"		md5="'+data.result_md5+'" >'+data.result+'</td>';
							a+='<td class="c-table__cell" id="logdata'+logdata+'">1</td>';
							a+='</tr>';
							if(data.idlogwa!==undefined){
								$("#data_sinkron").prepend(a);
								$("body").attr("logdata",logdata);	
							} 
						}else{ var logdata_value=parseInt($("#logdata"+logdata).html()); $("#logdata"+logdata).html(++logdata_value); }
						
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
						setTimeout(function(){ LinkOtomasi(idwa); }, 500);
					}
					).fail(function(){ consol.log('Response Failed'); });
			}			
			setTimeout(function(){ LinkOtomasi(<?php echo $_GET["idwa"]; ?>); }, 2000);
			
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
		<link rel="shortcut icon" href="whatsapp-icon.png" type="image/png">
    </head>
    <body class="o-page o-page--center" id="body" logdata="">

        <div class="o-page__card u-width-75">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-pt-large">
                    <span class="c-card__icon" style="background: limegreen;">
                        <i class="u-h2 fas fa-sync-alt icon-repeat" id="icox"></i>
                    </span>
                    <h1 class="u-h3 u-text-center u-mb-zero">Kirim Notifikasi Whatsapp</h1>
                </header>

                <div class="c-card__body">
                    <h2 class="u-h5 u-text-center"><?php echo rootdir(); ?></h2>
                    <h2 class="u-h5 u-text-center"><?php echo "Nohp Whatsapp : ".$nohp_wa["nohp_wa"]; ?></h2>
                    <h3 class="u-h5 u-text-center" style="color: limegreen;" id="progress_data"><?php if(isset($current_data) && $current_data!=" <br>  <br> ") echo $current_data; else echo '<i class="fas fa-angle-double-left"></i><i class="fas fa-minus"></i><i class="fas fa-angle-double-right"></i>'; ?></h3>

					<table class="c-table u-width-100">
						<thead class="c-table__head c-table__head--slim">
							<tr class="c-table__row">
								<th class="c-table__cell c-table__cell--head">ID Log WA</th>
								<th class="c-table__cell c-table__cell--head">Nohp Tujuan</th>
								<th class="c-table__cell c-table__cell--head" width="300">Pesan</th>
								<th class="c-table__cell c-table__cell--head">Waktu</th>
								<th class="c-table__cell c-table__cell--head">Status Kirim</th>
								<th class="c-table__cell c-table__cell--head">Progress</th>
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