<?php include("code/home_code.php"); ?> <div class="hero">
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
          <img style="width: 70%" class="img-responsive" src="
						<?php echo siteUrl();?>sub-www/images/logo/RISETOSERVE-WHITE-01.png" alt="PMPLAND">
        </h1>
      </div>
    </div>
  </div>
</div>
<div class="section bg-light" id="proyek">
  <div class="container text-center">
    <div class="row mb-5 align-items-center">
      <div class="col-lg-12">
        <h2 class="font-weight-bold text-primary heading Aeonik"> Proyek Perumahan </h2>
      </div>
      <div class="col-lg-6 text-lg-end d-none">
        <p>
          <a style="background: #DB0000 !important;" href="
							<?php echo siteUrl();?>proyek-perumahan/#proyek" class="btn btn-danger text-white py-1 px-3">Lihat Semua Proyek </a>
        </p>
      </div>
    </div>
    <div class="row" style="margin-top: -20px;">
      <img style="padding:20px;" src="
					<?php echo siteUrl();?>sub-www/images/logo/proyeklogo.png" alt="Image" class="img-fluid">
    </div>
    <div class="row">
      <div class="col-12">
        <div class="property-slider-wrap">
          <div class="property-slider" style="position: relative;"> <?php foreach($proyeksAll AS $proyek){ ?> <div class="property-item" data-bs-toggle="modal" data-bs-target="#homeBackdrop
									<?php echo $proyek['idwebproyek'];?>">
              <a class="img zoom-container">
                <img src="
											<?php echo siteUrl();?>sub-www/images/proyek/
											<?php echo $proyek['img_proyek']; ?>" alt="Image" class="img-fluid zoom-image" />
                <div class="ytxtproyekslide">
                  <span class="city mb-3 text-center"> <?php echo $proyek['nama_proyek']; ?> </span>
                </div>
              </a>
            </div> <?php } ?> </div>
          <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
          </div>
        </div>
        <p class="text-center">
          <a style="background: #DB0000 !important;" href="<?php echo siteUrl();?>proyek-perumahan/#proyek" class="btn btn-danger text-white py-1 px-3">
            <i class="fas fa-map-marker-alt text-white me-1"></i> Lihat Semua Proyek </a>
        </p>

        <div class="modal fade" id="homeBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">MULIA LAND, CILEDUG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="section section-4 bg-light" id="profile" style="padding-top: 1rem; padding-bottom: 1rem;">
                  <div class="container">
                    <div class="row justify-content-between mb-1">
                      <div class="col-lg-4 mb-1 mb-lg-0 order-lg-2">
                        <div class="d-flex feature-h">
                          <div class="feature-text">
                            <h3 class="heading">Deskripsi : </h3>
                            <p class="text-black-50">
                            <table class="table">
                              <tr>
                                <td>Tipe Unit</td>
                                <td> : </td>
                                <td>Subsidi</td>
                              </tr>
                              <tr>
                                <td>Harga</td>
                                <td> : </td>
                                <td>Rp. XXX</td>
                              </tr>
                              <tr>
                                <td>Luas Bangunan</td>
                                <td> : </td>
                                <td>30 m 2</td>
                              </tr>
                              <tr>
                                <td>Luas Lahan</td>
                                <td> : </td>
                                <td>60 m 2</td>
                              </tr>
                              <tr>
                                <td>Kamar Tidur</td>
                                <td> : </td>
                                <td>2 kamar</td>
                              </tr>
                              <tr>
                                <td>Kamar Mandi</td>
                                <td> : </td>
                                <td>1 kamar</td>
                              </tr>
                            </table>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 mb-1 mb-lg-0 order-lg-2">
                        <div class="d-flex feature-h">
                          <div class="feature-text">
                            <h3 class="heading">Spesifikasi Teknis </h3>
                            <p class="text-black-50">
                            <table class="table">
                              <tr>
                                <td>Atap</td>
                                <td> : </td>
                                <td>Genteng</td>
                              </tr>
                              <tr>
                                <td>Dinding</td>
                                <td> : </td>
                                <td>Bata Ringan</td>
                              </tr>
                              <tr>
                                <td>Lantai</td>
                                <td> : </td>
                                <td>Keramik 40x40</td>
                              </tr>
                              <tr>
                                <td>Pondasi</td>
                                <td> : </td>
                                <td>Batu kali</td>
                              </tr>
                            </table>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 mb-1 mb-lg-0 order-lg-2">
                        <div>
                          <img src="
																	<?php echo siteUrl();?>sub-www/images/denah.jpg" alt="Image" class="img-thumbnail" />
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
      </div>
    </div>
  </div>
</div>
<div class="section section-4" id="profiles">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-5">
        <h2 class="font-weight-bold heading text-primary mb-4" style="font-family: 'AeonikAir' !important;"> Profile PMPLand </h2>
        <p class="text-black-50"> MEMBANGUN HARAPAN MASA DEPAN </p>
      </div>
    </div>
    <div class="row justify-content-between mb-5">
      <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
        <div class="img-about dots">
          <img style="background-color: #212c3c; padding:50px;" src="
										<?php echo siteUrl();?>sub-www/images/logo/PMPLand-GROUPLOGO-WHITE-FINAL.png" alt="Image" class="img-thumbnail" />
        </div>
      </div>
      <div class="col-lg-7">
        <div class="d-flex feature-h">
          <span class="wrap-icon me-3 d-none">
            <span class="icon-person"></span>
          </span>
          <div class="feature-text">
            <h3 class="heading" style="font-family: 'AeonikAir' !important;">Latar Belakang</h3>
            <p class="text-black-50" style="text-align: justify;"> &nbsp;&nbsp;&nbsp;&nbsp;Memiliki hunian yang murah, nyaman, berkualitas adalah impian semua orang. Berdiri pada tahun 2019, PMPLand memulai perjalanan sebagai pengembang properti yang berkomitmen untuk memenuhi kebutuhan rumah bagi masyarakat. Para founder menginginkan PMPLand mampu berdiri sebagai sebuah legacy. Artinya, dikenal bukan hanya bisnis saja, tapi juga memiliki nilai dan manfaat bagi banyak orang. Bersama tagline “rise to serve”, PMPLand terus melebarkan sayapnya, merambah ke berbagai kota di Indonesia untuk menghadirkan hunian berkualitas dengan pelayanan terbaik. </p>
            <p>
              <a data-bs-toggle="modal" data-bs-target="#visimisi" style="background: #DB0000 !important;" href="
													<?php echo siteUrl();?>proyek-perumahan/#proyek" class="btn btn-danger text-white py-1 px-3 mt-1">Visi & Misi PMPLand </a>
            </p>
            <div class="modal fade" id="visimisi" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <div style="text-align: center; width:100%;">
                      <h5 class="modal-title" style="color: #DB0000 !important;">Visi Misi PMPLand</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row justify-content-between mb-1">
                      <div class="col-lg-12 text-center">
                        <div class="d-flex feature-h">
                          <div class="feature-text">
                            <h3 class="heading" style="font-family: 'AeonikAir' !important;">Visi</h3>
                            <p class="text-black-50"> Menjadi Perusahaan yang kompetitif dan bernilai tambah secara berkelanjutan di Indonesia. Yang didukung dengan sistem perusahaan dan sumber daya manusia yang berkualitas untuk menghasilkan kreasi dan inovasi terhadap perubahan yang terjadi dari waktu ke waktu. </p>
                          </div>
                        </div>
                        <div class="d-flex feature-h">
                          <div>
                            <h3 class="heading">Misi</h3>
                            <p class="text-black-50"> - Memberikan hunian yang layak dan bernilai tambah. <br> - Merekrut dan mengembangkan SDM yang berkualitas Baik, Profesional dan berorientasi terhadap layanan konsumen. <br> - Membangun perusahaan yang memiliki sistem yang baik dan berkepanjangan. <br> - Berusaha untuk menjadi pengembang yang kompetitif di Indonesia. <br> - Senantiasa melakukan inovasi, kreativitas, dan fleksibel terhadap perubahan yang terjadi dari waktu ke waktu. </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section section-5 bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8 mb-5">
        <h2 class="font-weight-bold heading text-primary mb-4 Aeonik"> MEMBANGUN HARAPAN MASA DEPAN </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-12 mb-8 mb-lg-0">
        <div class="h-100 person">
          <img src="<?php echo siteUrl();?>sub-www/images/ceo/ceo_yudho.jpg" alt="Image" class="img-fluid" />
          <div class="person-contents">
            <h2 class="mb-0 Aeonik">
              <a href="#">Yudho Arlianto</a>
            </h2>
            <span class="meta d-block mb-3 Aeonik">Chief Executive Officer</span>
            <p> PMPLand bukan hanya sebuah bisnis, tapi rumah yang diisi sebuah keluarga dengan beragam kisah <br> dan berharap bisa menginspirasi berbagai pihak, lintas budaya dan lintas generasi. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section sec-testimonials">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="text-align:center;">
        <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0"> Mitra Perusahaan </h2>
      </div>
      <!-- <div class="col-12 col-lg-3" style="text-align:center;" data-aos="fade-up" data-aos-delay="300"> &nbsp; </div> -->
      <div class="col-12 m" style="text-align:center;" data-aos="fade-up" data-aos-delay="300">
        <img style="padding:40px;" src="<?php echo siteUrl();?>sub-www/images/mitra/mitralogo_new.webp" alt="Image" class="img-fluid">
      </div>
      <!-- <div class="col-12 col-lg-3" style="text-align:center;" data-aos="fade-up" data-aos-delay="300">
        <img style="padding:20px;" src="
																	<?php echo siteUrl();?>sub-www/images/mitra/logo-btn-syariah.png" alt="Image" class="img-fluid">
      </div>
      <div class="col-12 col-lg-3" style="text-align:center;" data-aos="fade-up" data-aos-delay="300"> &nbsp; </div> -->
    </div>
  </div>
</div>
<div class="section bg-light" id="artikel">
  <div class="container">
    <div class="row mb-4 align-items-center">
      <div class="col-12 col-lg-6">
        <h3 class="heading" style="font-family: 'AeonikAir' !important; font-size: 21px; border-bottom:red 1px solid; width:80px;">Artikel</h3>
      </div>
      <div class="col-12 col-lg-6 text-lg-end text-start mt-2 mt-lg-0"> <?php if($jmlArtikel > 0) { ?> 
        <a href="<?php echo siteUrl(); ?>artikel/page/1" class="btn btn-danger text-white py-1 px-3" style="background: #DB0000 !important; font-family: 'AeonikAir' !important; font-size: 14px;"> Lihat Semua Artikel </a> <?php } ?> </div>
    </div>
    <div class="row"> <?php if($jmlArtikel > 0) { ?> 
      <?php foreach($artikelHome as $artikel) { 
        ?> 
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
        <div class="card flex-fill text-left img zoom-container ">
          <div class="card-body d-flex flex-column">
            <a target="_blank" href='<?php echo siteUrl() . "artikel/" . sanitizeString($artikel["judul_artikel"], $artikel["idartikel"]) ?>' >
              <div class="image-container">
                <img class="card-image img-fluid zoom-imageartikel " style="background: #212C3C;" src="<?php echo $artikel["header_konten"]; ?>">
              </div>
              <p class="card-subtitle mt-2 text-muted"><small> <?= FormatTgl($artikel['tgl_publish'],"3digit-id") ?> </small></p>
              <!-- <span class="badge badge-pill" style="background-color: <?= $artikel["warna"];?>; color: white;"><?= $artikel["kategori"]?></span>  -->
                <span class="badge badge-pill" 
                  style="
                    background-color: <?= $artikel["warna"];?>; 
                    color: <?= isCloseToWhite($artikel["warna"]) ? "black" : "white"; ?>; 
                    <?= isCloseToWhite($artikel["warna"]) ? 'border: 1px solid black;' : '' ?>
                  ">
                  <?= $artikel["kategori"]?>
                </span>
              <p style="font-size: 15px; font-weight: bold;" class="card-title mt-1"> 
                <?= $artikel["judul_artikel"] ?> 
              </p>
            </a>
          </div>
        </div>
      </div> <?php } ?> <?php } else { ?> <p class="text-black-50" style="text-align: justify;">Saat ini, belum tersedia artikel</p> <?php } ?> </div>
  </div>
</div>
<div class="section" id="karir">
  <div class="container">
    <div class="row mb-4 align-items-center">
      <div class="col-12 col-lg-6">
        <h3 class="heading" style="font-family: 'AeonikAir' !important; font-size: 21px; border-bottom:red 1px solid; width:80px;">Karir</h3>
      </div>
      <div class="col-12 col-lg-6 text-lg-end text-start mt-2 mt-lg-0"> <?php if($jmlKarir > 0) { ?> 
        <a href="<?php echo siteUrl(); ?>karir/page/1" class="btn btn-danger text-white py-1 px-3" style="background: #DB0000 !important; font-family: 'AeonikAir' !important; font-size: 14px;"> Lihat Semua Lowongan </a> <?php } ?> </div>
    </div>
    <div class="row"> <?php if($jmlKarir > 0) { ?> 
      <?php foreach($karirHome as $karir) { 
        ?> 
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
        <div class="card flex-fill text-left img zoom-container ">
          <div class="card-body d-flex flex-column">
            <a target="_blank" href='<?php echo siteUrl() . "karir/" . "lowongan-kerja-".sanitizeString($karir["judul_artikel"], $karir["idartikel"]) ?>' >
        
              <div class="image-container">
                <img class="card-image img-fluid zoom-imageartikel " style="background: #212C3C;" src="<?php echo $karir["header_konten"]; ?>">
              </div>
              <p class="card-subtitle mt-2 text-muted"><small> <?= FormatTgl($karir['tgl_publish'],"3digit-id") ?> </small></p>
                <span class="badge badge-pill" 
                  style="
                    background-color: <?= $karir["warna"];?>; 
                    color: <?= isCloseToWhite($karir["warna"]) ? "black" : "white"; ?>; 
                    <?= isCloseToWhite($karir["warna"]) ? 'border: 1px solid black;' : '' ?>
                  ">
                  <?= $karir["kategori"]?>
                </span>
              <p style="font-size: 15px; font-weight: bold;" class="card-title mt-1"> 
                  <?= $karir["judul_artikel"] ?> 
                  <!-- <span class="badge badge-pill" style="background-color: <?= $karir["warna"];?>; color: white;"><?= $karir["kategori"]?></span>  -->
              </p>
            </a>

          </div>
        </div>
      </div> <?php } ?> <?php } else { ?> <p class="text-black-50" style="text-align: justify;">Saat ini, belum tersedia lowongan</p> <?php } ?> </div>
  </div>
</div>
<div class="section section-4 bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-5">
        <h2 class="font-weight-bold heading text-primary mb-4"> Pengunjung Website </h2>
      </div>
    </div>
    <div class="row section-counter mt-5" style="text-align:center">
      <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number">
            <span class="countup text-primary"> <?php echo $pengunjungonline; ?> </span>
          </span>
          <span class="caption text-black-50"># online</span>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number">
            <span class="countup text-primary"> <?php echo $pengunjung; ?> </span>
          </span>
          <span class="caption text-black-50"># hari ini</span>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
        <div class="counter-wrap mb-5 mb-lg-0">
          <span class="number">
            <span class="countup text-primary"> <?php echo $totalpengunjung['hits']; ?> </span>
          </span>
          <span class="caption text-black-50"># telah berkunjung</span>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo siteUrl();?>sub-www/js/js-global-auth/home.js"></script>