<?php if($_SESSION["sess"]["iduser"]>0) $headerColor="#222c3c"; else $headerColor=""; ?>
<header class="d-block u-p-small" style="background-color: <?php echo $headerColor; ?>;justify-content: space-between;<?php if(isset($_GET["subpg"]) || $_SESSION["sess"]["iduser"]>0) echo "margin-bottom: 0px;" ?>">


        <?php if($_SESSION["sess"]["iduser"]>0 && !$device->isMobile()){ ?>
            
			
		
		
			<div class="btn-group u-flex u-justify-between" id="main-nav-desktop">
			
				<div class="u-block-inline">
					<?php if($_SERVER["SERVER_NAME"]=="app.pmpland.co.id"){ ?>
					<a class="reset-data-delivery"><img src="./img-pmpland-header-logo-desktop.png" alt="PMPLand"></a>
					<?php } ?>
				</div>
				
			  	<div class="btn-group">
					<div class="btn-group">
						<a class="btn btn-light dropdown-toggle" data-toggle="dropdown" style="border-radius: 5px;"><i class="fas fa-bars"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="./dashboard-edit-profile.html"><i class="fas fa-user-edit" style="color: darkblue;"></i> Edit Profile</a>
						<div class="dropdown-divider"></div>
						
						<a class="dropdown-item modal-confirm" confirmtext="Konfirmasi logout?" addclassbtn="logout-btn"><i class="fas fa-sign-out-alt" style="color: darkred;"></i> Logout</a>
						</div>
					</div>
				</div>

			</div>


		
		
		<?php }else{ ?>
           

           
			<?php if($_SESSION["sess"]["iduser"]>0){ ?>
			<div class="d-block">
				<div class="row">
					<div class="col-3 u-flex u-justify-start  u-align-items-center u-pts-xsmall">
						<button class="c-nav-toggle button-menu-header-mobile u-m-zero u-bg-secondary" type="button" data-toggle="collapse" data-target="#main-nav" style="border-radius: 5px;">
							<i class="fas fa-bars"></i>
						</button>
					</div>
					<div class="col-6 u-flex u-justify-center u-p-zero" style="width: 150px !important;">
						<a class="reset-data-delivery"><img src="./img-pmpland-header-logo-mobile.png" alt=""></a>
					</div>
					<div class="col-3 u-flex u-justify-end u-align-items-center ">
						<button class="c-nav-toggle u-m-zero u-bg-secondary" type="button" data-toggle="collapse" data-target="#notifikasi_header" style="border-radius: 5px;">
							<i class="fas fa-bell"></i>
						</button>
					</div>
				</div>      
			</div>
	
	
			<!-- Mobile View -->
            <nav class="c-nav collapse u-bg-secondary" id="main-nav">
                <ul class="c-nav__list">
                    
						
						<li class="c-nav__item">
							<a class="c-nav__link menu-header-mobile" href="./dashboard-admin-data-whatsapp-sender.html">
								<div class="u-inline-block" style="width: 30px;"><i class="fab fa-whatsapp"></i></div>
								<div class="u-inline-block">Whatsapp Sender</div>
							</a>
						</li>
						<li class="c-nav__item">
							<a class="c-nav__link menu-header-mobile" href="./dashboard-admin-data-email-sender.html">
								<div class="u-inline-block" style="width: 30px;"><i class="far fa-envelope"></i></div>
								<div class="u-inline-block">Email Sender</div>
							</a>
						</li>
						<li class="c-nav__item">
							<a class="c-nav__link menu-header-mobile" href="./dashboard-admin-data-operator.html">
								<div class="u-inline-block" style="width: 30px;"><i class="fas fa-users-cog"></i></div>
								<div class="u-inline-block">Data Operator</div>
							</a>
						</li>
						<li class="c-nav__item">
							<a class="c-nav__link menu-header-mobile" href="./dashboard-admin-access-rights.html">
								<div class="u-inline-block" style="width: 30px;"><i class="fas fa-user-lock"></i></div>
								<div class="u-inline-block">Hak Akses</div>
							</a>
						</li>

						<!-- <li class="c-nav__item">
							<a class="c-nav__link" href="./dashboard-edit-profile.html">Edit Profile</a>
						</li> -->
						<li class="c-nav__item u-p-small " style="background-color:#eef3f6;border-top: solid 1px lightgrey;border-bottom: solid 0px white;">
							<a class="c-nav__link menu-header-mobile logout-btn" href="#">
								<div class="u-inline-block" style="width: 30px;"><i class="fas fa-sign-out-alt"></i></div>
								<div class="u-inline-block">Logout</div>
							</a>
						</li>
                </ul>
            </nav>
            <!-- // Navigation items  -->
			<!-- Mobile View *** Keranjang Belanja Expanded TopDown-->
			<nav class="c-nav collapse u-bg-secondary" id="notifikasi_header">
				<div class="d-block u-p-small" id="data_notifikasi_header">
					<?php 
					
					/* $inc=1; 
					include("sub-member/ajax/ajax-dashboard-member-update-keranjang-belanja.php"); 
					echo $status["data_keranjang"]; */

					?>Tidak ada notifikasi
				</div>
			</nav>


			<?php } ?>


		<?php } ?>
</header>