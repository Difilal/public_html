

			
	<div class="row u-mb-large" style="margin-top: 20px;">
		<div class="col-sm-12">
			
			
			<div class="o-page__card">
				<div class="c-card u-mb-xsmall">

					<div class="c-card__body">
						<div class="c-field u-mb-small" id="serial_number-wrapper">
							<label class="c-field__label" for="serial_number">Serial Number</label> 
							<input class="c-input focus-onload" type="text" id="serial_number" value="" style="text-transform: uppercase;">
						</div>
						<div class="c-field u-mb-small" id="idcabang-wrapper">
							<label class="c-field__label" for="idcabang">Cabang</label>
							<select class="form-control u-width-100" id="idcabang">
								<?php $mqr=mysqli_query($_SESSION["sess"]['koneksi'],"SELECT * FROM data_cabang ORDER BY nama_cabang ASC");
								while($data=mysqli_fetch_array($mqr)){ ?>
								<option value="<?php echo $data["idcabang"]; ?>"><?php echo $data["nama_cabang"]; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="c-field u-mb-small" id="status_layanan-wrapper">
							<label class="c-field__label" for="status_layanan">Status Layanan</label>
							<select class="form-control u-width-100" id="status_layanan">
								<option value="nonaktif">nonaktif</option>
								<option value="aktif">aktif</option>
							</select>
						</div>

						<button id="TambahDataMesin" class="c-btn c-btn--info c-btn--fullwidth" type="submit">Tambah</button>
					</div>
				</div>

			</div>

			
		</div>
	</div>