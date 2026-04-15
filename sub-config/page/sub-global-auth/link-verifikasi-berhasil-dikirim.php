		<div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="u-mv-small u-text-center" style="">
                        <h2 class="u-mb-xsmall">Link Verifikasi Berhasil Dikirim</h2>
                        <p class="u-text-mute u-h6">Silahkan cek email untuk verifikasi.</p>
                    </div>
                </div>
            </div>
			
            <div class="row">
            <div class="form-wa-link">
				Kami telah mengirim link verifikasi ke email anda, silahkan cek di folder inbox atau folder spam email anda. Klik link yang ada di email tersebut untuk verifikasi akun. <a href="https://www.gmail.com/" target="_blank">Klik disini untuk cek email</a>
				<?php if(isset($_SESSION["sendmail_email"]) &&  (!isset($_SESSION["sess"]["KirimLinkAktivasi"]) || (isset($_SESSION["sess"]["KirimLinkAktivasi"]) && $_SESSION["sess"]["KirimLinkAktivasi"]<3))){ ?>
					<br><br>
					Jika email tidak terkirim, tekan tombol dibawah ini.
					<a href="#" id="btn1" class="btn btn-sm btn-secondary">Kirim ulang link aktivasi<span id="counter"> - 00:45</span></a>				
					<a href="#" id="kirim-link-aktivasi" class="btn btn-sm btn-primary" style="display: none;">Kirim ulang link aktivasi</a>
					<input type="hidden" id="email" value="<?php echo $_SESSION["sendmail_email"]; ?>">
					<input type="hidden" id="timer-kirim-ulang" value="120">
					<script>

						$(document).ready(function(){ countdown(); });
						function countdown(){
							sisaval=parseInt($("#timer-kirim-ulang").val());
							dig1=Math.floor(sisaval/60); if(dig1<10) dig1="0"+dig1;
							dig2=Math.floor(sisaval%60); if(dig2<10) dig2="0"+dig2;
							textleft=" - "+dig1+":"+dig2;
							$("#counter").text(textleft);
							if(sisaval>0){ $("#timer-kirim-ulang").val((sisaval-1));
							setTimeout(function(){ countdown(); }, 1000); }
							else{ $("#btn1").hide(); $("#kirim-link-aktivasi").show(); }
						}

					</script>
				<?php } ?>
            </div>
        	</div>
        </div>
