
					
					

			<div class="row u-mb-small">
				<div class="col-4">Nama Kontak</div>
				<div class="col-8" id="smtp_name-wrapper">
				<input class="c-input" type="text" id="smtp_name" placeholder="">
				</div>
				<input type="hidden" id="" value="">
			</div>
			<div class="row u-mb-small">
				<div class="col-4">Email</div>
				<div class="col-8" id="smtp_user-wrapper">
				<input class="c-input" type="text" id="smtp_user" placeholder="">
				</div>
				<div class="col-4"></div>
				<div class="col-8">
				</div>
			</div>
			<div class="row u-mb-small">
				<div class="col-4">Password</div>
				<div class="col-8" id="smtp_pswd-wrapper">
                    <div class="c-field has-icon-right">
					<input class="c-input pswd" type="text" id="smtp_pswd" placeholder="">
					<span class="c-field__icon">
						<i class="far fa-eye-slash u-pt-zero toggle-text-password cursor-pointer" targetid="smtp_pswd"></i>
					</span>
					</div>
				</div>
			</div>
			<div class="row u-mb-small">
				<div class="col-4">SMTP Server</div>
				<div class="col-8" id="smtp_host-wrapper">
				<input class="c-input" type="text" id="smtp_host" placeholder="">
				</div>
			</div>
			<div class="row u-mb-xsmall">
				<div class="col-4">SMTP Port</div>
				<div class="col-8" id="smtp_port-wrapper">
				<input class="c-input filter-number" min="0" max="65535" type="text" id="smtp_port" value="">
				</div>
			</div>
			<div class="row u-mb-xsmall">
				<div class="col-4">Encryption</div>
				<div class="col-8" id="smtp_secure-wrapper">
					<select class="form-control" name="smtp_secure" id="smtp_secure">
						<option value="PHPMailer">PHPMailer</option>
						<option value="TLS">TLS</option>
					</select>
				</div>
			</div>
			<div class="row u-mb-xsmall">
				<div class="col-4">Require Auth</div>
				<div class="col-8" id="smtp_auth-wrapper">
					<select class="form-control" name="smtp_auth" id="smtp_auth">
						<option value="True">True</option>
						<option value="False">False</option>
					</select>
				</div>
			</div>

			<div class="row u-mb-xsmall" id="api_key-wrapper">
				<div class="col-4 u-pr-zero">
					<input type="hidden" id="smtp_status" value="disconnected">
					<button id="tesKoneksiAkunEmailSender" class="c-btn c-btn--success c-btn--fullwidth" type="submit">Tes Koneksi</button>
				</div>
				<div class="col-8">
					<button id="tambahAkunEmailSender" class="c-btn c-btn--info c-btn--fullwidth" type="submit">Tambah</button>
				</div>
			</div>