<?php

if(!isset($_POST["idsmtp"])) exit;
if(cekdata("data_email_sender","idsmtp='".escStringDB($_POST["idsmtp"])."'")==0){ echo "Akun SMTP tidak valid"; exit; }
else $datasmtp=getdata("data_email_sender","idsmtp='".escStringDB($_POST["idsmtp"])."'");


?>
					
					

			<div class="row u-mb-small">
				<div class="col-4">Nama Kontak</div>
				<div class="col-8" id="smtp_name-wrapper">
				<input type="hidden" id="idsmtp" value="<?php echo $datasmtp["idsmtp"]; ?>">
				<input type="hidden" id="smtp_status" value="<?php echo $datasmtp["smtp_status"]; ?>">
				<input class="c-input" type="text" id="smtp_name" value="<?php echo $datasmtp["smtp_name"]; ?>">
				</div>
				<input type="hidden" id="" value="">
			</div>
			<div class="row u-mb-small">
				<div class="col-4">Email</div>
				<div class="col-8" id="smtp_user-wrapper">
				<input class="c-input" type="text" id="smtp_user" value="<?php echo $datasmtp["smtp_user"]; ?>">
				</div>
				<div class="col-4"></div>
				<div class="col-8">
				</div>
			</div>
			<div class="row u-mb-small">
				<div class="col-4">Password</div>
				<div class="col-8" id="smtp_pswd-wrapper">
                    <div class="c-field has-icon-right">
					<input class="c-input pswd" type="text" id="smtp_pswd" value="<?php echo passwordDecrypt($datasmtp["smtp_pswd"]); ?>">
					<span class="c-field__icon">
						<i class="far fa-eye-slash u-pt-zero toggle-text-password cursor-pointer" targetid="smtp_pswd"></i>
					</span>
					</div>
				</div>
			</div>
			<div class="row u-mb-small">
				<div class="col-4">SMTP Server</div>
				<div class="col-8" id="smtp_host-wrapper">
				<input class="c-input" type="text" id="smtp_host" value="<?php echo $datasmtp["smtp_host"]; ?>">
				</div>
			</div>
			<div class="row u-mb-xsmall">
				<div class="col-4">SMTP Port</div>
				<div class="col-8" id="smtp_port-wrapper">
				<input class="c-input filter-number" min="0" max="65535" type="text" id="smtp_port" value="<?php echo $datasmtp["smtp_port"]; ?>">
				</div>
			</div>
			<div class="row u-mb-xsmall">
				<div class="col-4">Encryption</div>
				<div class="col-8" id="smtp_secure-wrapper">
					<select class="form-control" name="smtp_secure" id="smtp_secure">
						<option value="PHPMailer"	<?php if($datasmtp["smtp_secure"]=="PHPMailer") echo "selected"; ?>>PHPMailer</option>
						<option value="TLS"			<?php if($datasmtp["smtp_secure"]=="TLS") 		echo "selected"; ?>>TLS</option>
					</select>
				</div>
			</div>
			<div class="row u-mb-xsmall">
				<div class="col-4">Require Auth</div>
				<div class="col-8" id="smtp_auth-wrapper">
					<select class="form-control" name="smtp_auth" id="smtp_auth">
						<option value="True"	<?php if($datasmtp["smtp_auth"]=="True")  echo "selected"; ?>>True</option>
						<option value="False"	<?php if($datasmtp["smtp_auth"]=="False") echo "selected"; ?>>False</option>
					</select>
				</div>
			</div>

			<div class="row u-mb-xsmall" id="api_key-wrapper">
				<div class="col-4 u-pr-zero">
					<input type="hidden" id="smtp_status" value="disconnected">
					<button id="tesKoneksiEditEmailSender" class="c-btn c-btn--success c-btn--fullwidth" type="submit">Tes Koneksi</button>
				</div>
				<div class="col-8">
					<button id="editAkunEmailSender" class="c-btn c-btn--info c-btn--fullwidth" type="submit">Simpan</button>
				</div>
			</div>