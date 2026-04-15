<?php

	$idwa		= $_GET["idwa"];
	$NohpWa		= getData("data_nohp_wa","idwa='".escStringDB($idwa)."'");

?><div class="container">

			
			<div class="row u-mb-large" style="margin-top: 20px;">
                <div class="col-sm-12">
					
					
					<div class="o-page__card">
						<div class="c-card u-mb-xsmall">
							<header class="c-card__header c-toolbar">
								<a class="c-btn c-btn--primary" href="./dashboard-admin-data-whatsapp-sender.html" style="padding: 0px 10px;margin-right: 5px;"><i class="fas fa-angle-left"></i></a>
								<a href=""><h1 class="c-toolbar__title u-h3 u-text-center u-mb-zero">Edit Nohp Whatsapp</h1></a>
							</header>

							<div class="c-card__body">
								<div class="c-field u-mb-small" id="nohp_wa-wrapper">
									<label class="c-field__label" for="sekolah">Nohp Whatsapp</label> 
									<input class="c-input focus-onload filter-number" type="text" id="nohp_wa" value="<?php echo $NohpWa["nohp_wa"]; ?>">
									<input type="hidden" id="idwa" value="<?php echo $NohpWa["idwa"]; ?>">
									<input type="hidden" id="idsekolah" value="<?php echo $NohpWa["idsekolah"]; ?>">
								</div>
								<div class="c-field u-mb-small" id="api_key-wrapper">
									<label class="c-field__label" for="sekolah">API Key</label> 
									<input class="c-input" type="text" id="api_key" value="<?php echo $NohpWa["api_key"]; ?>">
								</div>
								<div class="c-field u-mb-small" id="vendor_wa-wrapper">
									<label class="c-field__label" for="vendor_wa">Vendor</label> 
									<select name="vendor_wa" id="vendor_wa" class="form-control">
										<option value="atbram"<?php 	if($NohpWa["vendor"]=="atbram") 	echo " selected"; ?>>AB</option>
										<option value="pesanenter"<?php if($NohpWa["vendor"]=="pesanenter") echo " selected"; ?>>PE</option>
									</select>
								</div>

								<button id="SimpanNohpWhatsapp" class="c-btn c-btn--info c-btn--fullwidth" type="submit">Simpan</button>
							</div>
						</div>

					</div>

                   
                </div>
            </div>
	

</div><!-- // .container -->