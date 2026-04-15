<?php

$operator=getData("data_karyawan","iduser='".$_GET["iduser"]."'");

?><div class="container">

			
			<div class="row u-mb-large" style="margin-top: 20px;">
                <div class="col-sm-12">
					
					
					<div class="o-page__card">
						<div class="c-card u-mb-xsmall">
							<header class="c-card__header c-toolbar">
								<a class="c-btn c-btn--primary" href="./dashboard-admin-data-operator.html" style="padding: 0px 10px;margin-right: 5px;"><i class="fas fa-angle-left"></i></a>
								<a href=""><h1 class="c-toolbar__title u-h3 u-text-center u-mb-zero">Edit Operator</h1></a>
							</header>

							<div class="c-card__body">
								<div class="c-field u-mb-small" id="nama-wrapper">
									<label class="c-field__label" for="nama">Nama</label> 
									<input class="c-input focus-onload" type="text" id="nama" value="<?php echo $operator["nama"]; ?>">
									<input type="hidden" id="iduser" value="<?php echo $_GET["iduser"]; ?>">
								</div>
								<div class="c-field u-mb-small" id="nohp-wrapper">
									<label class="c-field__label" for="nohp1">Nohp Whatsapp</label> 
									<input class="c-input filter-number" type="text" id="nohp1" value="<?php echo $operator["nohp1"]; ?>">
								</div>
								<div class="c-field u-mb-small" id="email-wrapper">
									<label class="c-field__label" for="email1">Email</label> 
									<input class="c-input" type="email" id="email1" value="<?php echo $operator["email1"]; ?>">
								</div>
								<div class="c-field u-mb-small" id="password-wrapper">
                        			<div class="c-field has-icon-right">
										<label class="c-field__label" for="password">Password <span class="u-text-xsmall u-opacity-medium">(Biarkan tetap kosong jika tidak dirubah)</span></label> 
										<input class="c-input pswd" type="text" id="password" placeholder="">
										<span class="c-field__icon">
											<i class="far fa-eye-slash u-pt-medium toggle-text-password cursor-pointer" targetid="password"></i>
										</span>
									</div>
								</div>
								<div class="c-field u-mb-small" id="role-wrapper">
										<label class="c-field__label" for="role">Role</label>
										<!-- Select2 jquery plugin is used -->
										<select class="form-control" id="role">
											<option value="operator"	<?php if($operator["role"]=="operator")    	echo "selected"; ?>>Operator</option>
											<option value="supervisor"	<?php if($operator["role"]=="supervisor")  	echo "selected"; ?>>Supervisor</option>
											<option value="manager"		<?php if($operator["role"]=="manager")     	echo "selected"; ?>>Manager</option>
											<option value="admin"       <?php if($operator["role"]=="admin")		echo "selected"; ?>>Administrator</option>
										</select>
								</div>
								<div class="c-field u-mb-small" id="jabatan-wrapper">
										<label class="c-field__label" for="jabatan">Jabatan</label>
										<select class="form-control" id="jabatan">
											<?php

											for($i=0;$i<count($_SESSION["sess"]["listJabatan"]);$i++)
											{
												echo '<option value="'.$_SESSION["sess"]["listJabatan"][$i].'" '; 
												if($operator["jabatan"]==$_SESSION["sess"]["listJabatan"][$i]) echo "selected"; 
												if($_SESSION["sess"]["listJabatan"][$i]=='-----') echo " disabled"; 
												echo '>';
												echo $_SESSION["sess"]["listJabatan"][$i];
												echo '</option>';
											}

											?>
										</select>
								</div>

								<button id="SimpanOperator" class="c-btn c-btn--info c-btn--fullwidth" type="submit">Simpan</button>
							</div>
						</div>

					</div>

                   
                </div>
            </div>
	

</div><!-- // .container -->