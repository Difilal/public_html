<?php $proyeksAll      = getData("SELECT * FROM web_proyek_data","","all")["data"]; ?> <div class="hero">
  <div class="hero-slide">
    <div class="img overlay" style="background-image: url('
			<?php echo siteUrl();?>sub-www/images/pmp_bg_3.jpg')">
    </div>
    <div class="img overlay" style="background-image: url('
			<?php echo siteUrl();?>sub-www/images/pmp_bg_2.jpg')">
    </div>
    <div class="img overlay" style="background-image: url('
			<?php echo siteUrl();?>sub-www/images/pmp_bg_1.jpg')">
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 text-center">
        <h1 class="heading" data-aos="fade-up">
          <img style="width:440px;" src="
						<?php echo siteUrl();?>sub-www/images/logo/RISETOSERVE-WHITE-01.png" alt="PMPLAND">
        </h1>
      </div>
    </div>
  </div>
</div>
<div class="section sec-testimonials" id="proyek">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="text-align:center;">
        <h2 class="font-weight-bold heading text-primary mb-4"> Proyek Perumahan PMPLand<br>
          <br>
        </h2>
      </div> <?php 
      foreach($proyeksAll AS $proyek){ 
        // if($proyek['deskripsi_proyek'] == ''){ $viewshow ='d-none'; }
        
        ?> 
        <?php if($proyek['video'] <> ''){ ?>
        <div data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $proyek['idwebproyek'];?>" class="col-6 col-md-3" style="margin-bottom:20px;" data-aos="fade-up" data-aos-delay="300">
        <?php }else{ ?>
        <div class="col-6 col-md-3" style="margin-bottom:20px;">
        <?php } ?>
        
        <a class="img zoom-container"> <?php 
              $dir        = "sub-www/images/proyek/";
              $file       = $proyek['img_proyek'];
              $dirsave    = "sub-www/images/proyek/";
              $a = $dirsave.$file;
              // $a          = Thumb43($dir,$file,400,400,"white",$dirsave,90);
              // $a          = explode("--",$a)[1];

              ?> <img src="
									<?php echo siteUrl();?>sub-www/images/proyek/<?php echo $proyek['img_proyek']; ?>" alt="Image" class="img-fluid zoom-image" />
          <div class="ytxtproyekslide2">
            <span class="city mb-3 text-center"> <b><?php echo $proyek['nama_proyek']; ?> </b></span>
          </div>
        </a>
      </div>
      <!-- Modal Detail -->
      <div class="modal fade" id="staticBackdrop
				<?php echo $proyek['idwebproyek'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <div style="text-align: center; width:100%;">
                <h5 class="modal-title" id="staticBackdropLabel" style="line-height:20px;"> <?php echo $proyek['nama_proyek'];?> </h5>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="section section-4 bg-light" style="padding-top: 1rem; padding-bottom: 1rem;">
                <div class="container">
                  <div class="row justify-content-between">
                    <div class="col-lg-4 order-lg-2 d-none">
                      <div> <?php if($proyek['denah_proyek']<>''){ ?> <img src="
																	<?php echo siteUrl();?>sub-www/images/proyek/
																	<?php echo $proyek['denah_proyek'];?>" alt="Image" class="img-thumbnail" /> <?php }else{ ?> <img src="
																		<?php echo siteUrl();?>sub-www/images/denah.jpg" alt="Image" class="img-thumbnail" /> <?php } ?> </div>
                    </div>
                    <div class="col-lg-4 order-lg-2 d-none">
                      <div class="d-flex feature-h" style="margin-bottom: 0px !important;">
                        <div class="feature-text" style="margin-top: 0px !important;">
                          <h3 class="heading">Deskripsi : </h3>
                          <p class="text-black-50"> <?php if($proyek['deskripsi_proyek']<>''){ ?> <?php echo nl2br($proyek['deskripsi_proyek']);?> <?php }else{ ?> tidak ada deskripsi! <?php } ?> </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 order-lg-2 d-none">
                      <div class="d-flex feature-h" style="margin-bottom: 0px !important;">
                        <div class="feature-text" style="margin-top: 0px !important;">
                          <h3 class="heading">Spesifikasi Teknis </h3>
                          <p class="text-black-50"> <?php if($proyek['spesifikasi_proyek']<>''){ ?> <?php echo nl2br($proyek['spesifikasi_proyek']);?> <?php }else{ ?> tidak ada spesifikasi! <?php } ?> </p>
                        </div>
                      </div>
                    </div>
                  </div> 
                  <?php if($proyek['video']<>''){?> <div class="row">
                    <div class="col-lg-12 d-none ">
                      <div class="py-2" style="text-align: center;">
                        <a data-bs-toggle="modal" data-bs-target="#videoBackdrop<?php echo $proyek['idwebproyek'];?>" style="" class="btn btn-danger text-white py-1 px-3"> <?php echo $proyek['judul1'];?> </a>
                      </div>
                    </div>
                  </div> 
                  <?php } ?>


                  <?php 
                  $viewshowspek   = ($proyek['spesifikasi_proyek'] == '') ? 'd-none' : '';
                  $viewshowsdes   = ($proyek['deskripsi_proyek'] == '') ? 'd-none' : '';
                  $viewshowsite   = ($proyek['siteplan'] == '') ? 'd-none' : '';
                  $viewshowloc    = ($proyek['maps'] == '') ? 'd-none' : '';
                  $viewshowbrosur = ($proyek['brosur'] == '') ? 'd-none' : '';

                  ?>
                  <!-- NAV TAB -->
                  <ul class="nav nav-tabs justify-content-center mb-4" id="projectTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#profile<?php echo $proyek['idwebproyek'];?>" type="button" role="tab">
                        <i class="fas fa-info-circle text-danger me-1"></i> About
                      </button>
                    </li>
                    <li class="nav-item <?php echo $viewshowloc; ?>" role="presentation">
                      <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#maps<?php echo $proyek['idwebproyek'];?>" type="button" role="tab">
                        <i class="fas fa-map-marker-alt text-danger me-1"></i> Lokasi
                      </button>
                    </li>
                    <li class="nav-item <?php echo $viewshowsite; ?>" role="presentation">
                      <button class="nav-link" id="siteplan-tab" data-bs-toggle="tab" data-bs-target="#siteplan<?php echo $proyek['idwebproyek'];?>" type="button" role="tab">
                        <i class="fas fa-drafting-compass text-danger me-1"></i> Siteplan
                      </button>
                    </li>
                    <li class="nav-item <?php echo $viewshowbrosur; ?>" role="presentation">
                      <button class="nav-link" id="brosur-tab" data-bs-toggle="tab" data-bs-target="#brosur<?php echo $proyek['idwebproyek'];?>" type="button" role="tab">
                        <i class="fas fa-drafting-compass text-danger me-1"></i> Brosur
                      </button>
                    </li>
                  </ul>

                  <!-- TAB CONTENT -->
                  <div class="tab-content" id="projectTabsContent">
                  
                    <!-- ABOUT -->
                    <div class="tab-pane fade show active" id="profile<?php echo $proyek['idwebproyek'];?>" role="tabpanel" aria-labelledby="location-tab">
                      <div class="section bg-light py-4 text-left">
                            <div class="row justify-content-between g-3">
                              <!-- Denah -->
                              <?php if($viewshowsdes == '' && $viewshowspek == ''){ ?>
                              <div class="col-lg-4">
                              <?php }else{ ?>
                              <div class="col-lg-12">
                              <?php } ?>
                                <div class="card border-0 shadow-sm h-100">
                                  <div class="card-header bg-danger text-white text-center fw-bold py-2">
                                    Denah Proyek
                                  </div>
                                  <div class="card-body text-center">
                                    <?php if($proyek['denah_proyek']<>''){ ?>
                                      <img src="<?php echo $proyek['denah_proyek'];?>" alt="Denah Proyek" class="img-fluid rounded shadow-sm" />
                                    <?php }else{ ?>
                                      <img src="<?php echo siteUrl();?>sub-www/images/denah.jpg" alt="Denah Default" class="img-fluid rounded shadow-sm" />
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>

                              <!-- Deskripsi -->
                              <div class="col-lg-4 <?php echo $viewshowsdes; ?>">
                                <div class="card border-0 shadow-sm h-100">
                                  <div class="card-header bg-danger text-white fw-bold py-2 text-center">
                                    Deskripsi
                                  </div>
                                  <div class="card-body">
                                    <p class="text-secondary mb-0" style="white-space: pre-line;">
                                      <?php echo $proyek['deskripsi_proyek']; ?>
                                    </p>
                                  </div>
                                </div>
                              </div>

                              <!-- Spesifikasi -->
                              <div class="col-lg-4 <?php echo $viewshowspek; ?>">
                                <div class="card border-0 shadow-sm h-100">
                                  <div class="card-header bg-danger text-white fw-bold py-2 text-center">
                                    Spesifikasi Teknis
                                  </div>
                                  <div class="card-body">
                                    <p class="text-secondary mb-0" style="white-space: pre-line;">
                                      <?php echo $proyek['spesifikasi_proyek']; ?>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Tombol Video -->
                            <?php if($proyek['video']<>''){ ?>
                            <div class="row mt-4">
                              <div class="col-lg-12 text-center">
                                <a data-bs-toggle="modal" data-bs-target="#videoBackdrop<?php echo $proyek['idwebproyek'];?>"
                                  class="btn btn-danger shadow-sm px-4 py-2 rounded-pill">
                                  <i class="fas fa-video me-2"></i> Lihat Video
                                </a>
                              </div>
                            </div>
                            <?php } ?>

                            <!-- Tambahan sedikit gaya -->
                            <style>
                            .card:hover {
                              transform: translateY(-4px);
                              transition: all 0.3s ease;
                            }
                            .card-header {
                              letter-spacing: 0.5px;
                            }
                            </style>
                      </div>
                    </div>

                    <!-- LOCATION -->
                    <div class="tab-pane fade" id="maps<?php echo $proyek['idwebproyek'];?>" role="tabpanel" aria-labelledby="location-tab">
                      <div class="section bg-light py-4 text-center">
                          <iframe src="<?php echo $proyek['maps']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                    </div>

                    <!-- SITEPLAN -->
                    <div class="tab-pane fade" id="siteplan<?php echo $proyek['idwebproyek'];?>" role="tabpanel" aria-labelledby="siteplan-tab">
                      <div class="section bg-light py-4 text-center">
                        <h3 class="mb-3">Siteplan</h3>
                        <img src="<?php echo $proyek['siteplan'];?>" class="img-fluid rounded" alt="Siteplan">
                      </div>
                    </div>

                    <!-- brosur -->
                    <div class="tab-pane fade" id="brosur<?php echo $proyek['idwebproyek'];?>" role="tabpanel" aria-labelledby="brosur-tab">
                      <div class="section bg-light py-4 text-center">
                        <h3 class="mb-3">Brosur</h3>
                        <img src="<?php echo $proyek['brosur'];?>" class="img-fluid rounded" alt="Siteplan">
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
            <div class="modal-footer d-none">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Understood</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Video -->
      <div class="modal fade" id="videoBackdrop<?php echo $proyek['idwebproyek'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <div style="text-align: center; width:100%;">
                <h5 class="modal-title" id="videoModalLabel"> <?php echo $proyek['nama_proyek'];?> </h5>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="display:block;width:100%;;margin-left:auto;margin-right:auto;">
                <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9" controls preload="auto" data-setup='{"fluid": true,"controls": true,"responsive": true}'>
                  <!-- sources -->
                  <source src="
																<?php echo $proyek['video'];?>" type="video/mp4">
                  <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                  </p>
                  <!-- Tambahkan sumber video lain sesuai kebutuhan (WebM, Ogg, dsb.) -->
                </video>
                <!-- $media  = '<div class="d-block u-text-center">';
                  $media .= '  <div style="display:block;width:100%;;margin-left:auto;margin-right:auto;">';
                  $media .= '    <video id="myvideo'.$_POST["randomNumber"].'" class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9" preload="auto" poster="" controls>';
                  $media .= '      <source src="'.$downLink.'" type="'.$mfa["type"].'" />';
                  $media .= '      <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>';
                  $media .= '    </video>';
                  $media .= '  </div>';
                  $media .= '</div>';-->
              </div>
            </div>
          </div>
        </div>
      </div> 

      
      
      <?php } ?>
    </div>
  </div>
</div>