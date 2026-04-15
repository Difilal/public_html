<?php

$idmesin	= $_POST["idmesin"]??-1;
$mesin		= getData("data_absensi_mesin","idmesin='".mysqli_real_escape_string($_SESSION["sess"]["koneksi"],$idmesin)."'");

?>
<div class="container">

			
	<div class="row u-mb-large" style="margin-top: 20px;">
		<div class="col-sm-12">
			
			
			<div class="o-page__card">
				<div class="c-card u-mb-xsmall">

					<div class="c-card__body">
						<div class="c-field u-mb-small" id="serial_number-wrapper">
							<input type="hidden" id="idmesin" value="<?php echo $mesin["idmesin"]; ?>">
							<label class="c-field__label" for="serial_number">Serial Number</label> 
							<input class="c-input focus-onload" type="text" id="serial_number" value="<?php echo $mesin["serial_number"]; ?>" style="text-transform: uppercase;">
						</div>
						<div class="c-field u-mb-small" id="idcabang-wrapper">
							<label class="c-field__label" for="idcabang">Cabang</label>
							<select class="form-control u-width-100" id="idcabang">
								<?php $mqr=mysqli_query($_SESSION["sess"]['koneksi'],"SELECT * FROM data_cabang ORDER BY nama_cabang ASC");
								while($data=mysqli_fetch_array($mqr)){ if($data["idcabang"]==$mesin["idcabang"]) $selected="selected"; else $selected=""; ?>
								<option value="<?php echo $data["idcabang"]; ?>" <?php echo $selected; ?>><?php echo $data["nama_cabang"]; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="c-field u-mb-small" id="status_layanan-wrapper">
							<label class="c-field__label" for="status_layanan">Status Layanan</label>
							<select class="form-control u-width-100" id="status_layanan">
								<option value="nonaktif" <?php 	echo $mesin["status_layanan"]=="nonaktif"?"selected":""; ?>>nonaktif</option>
								<option value="aktif" <?php 	echo $mesin["status_layanan"]=="aktif"?"selected":""; 	 ?>>aktif</option>
							</select>
						</div>

						<button id="SimpanDataMesin" class="c-btn c-btn--info c-btn--fullwidth" type="submit">Simpan</button>
					</div>
				</div>

			</div>

			
		</div>
	</div>
	

</div><!-- // .container -->