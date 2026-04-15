<style>
.map-container {
  position: relative;
  display: inline-block;
}

.map-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.map-pin-link {
  position: absolute;
  text-decoration: none;
  cursor: pointer;
  transform: scale(0);
  opacity: 0;
  transition: all 0.4s ease;
}

/* Pin muncul saat hover */
.map-container:hover .map-pin-link {
  opacity: 1;
  transform: scale(1);
}

/* Icon pin */
.map-pin {
  font-size: 28px;
  color: red;
  text-shadow: 0 0 4px rgba(0,0,0,0.4);
}

/* Posisi */
.pin-jawa {
  top: -122px;     /* ini akan benar-benar naik sekarang */
  left: 28%;
}

.pin-jakarta {
  top: -132px;     /* ini akan benar-benar naik sekarang */
  left: 18%;
}

@media (max-width: 768px) {
  .map-container {
    max-width: 100%;
  }

 /* Posisi */
.pin-jawa {
  top: -95px;     /* ini akan benar-benar naik sekarang */
  left: 28%;
}

.pin-jakarta {
  top: -98px;     /* ini akan benar-benar naik sekarang */
  left: 13%;
}
}
</style>
<div class="site-footer" id="site-footer">
      <div class="container">
        <div class="row">
          <!-- /.col-lg-4 -->
          <div class="col-lg-2">
            <div class="widget">
              <h3>PMPLand</h3>
              <ul class="list-unstyled links">
              <?php if($_SESSION['modpage'] = 'proyek'){ ?>
                <li><a class="linkmodf" href="<?php echo siteUrl(); ?>">Beranda</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#profiles">Tentang Kami</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#proyek">Proyek</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#artikel">Artikel</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#karir">Karir</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#site-footer">Hubungi Kami</a></li>
                <?php }else{ ?>
                <li><a class="linkmodf" href="<?php echo siteUrl(); ?>">Beranda</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#profiles">Tentang Kami</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#proyek">Proyek</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#artikel">Artikel</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#karir">Karir</a></li>
                <li><a class="linkmodf" href="<?php echo siteUrl();?>#site-footer">Hubungi Kami</a></li>
                <?php } ?>

              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-5">
            <div class="widget" style="margin-bottom: 20px !important;">
              <h3 style="margin-bottom: 1px !important;">PMPLand Head Office</h3>
              <address style="margin-bottom: 10px !important;">Jl. Saleh No.78A, Kesenden, Kec. Kejaksan, Kota Cirebon, Jawa Barat 45121</address>
              <span class="mb-2">(0231) 8808194 - +62812-2446-6679</span>
            </div>
            <div class="widget" style="margin-bottom: 20px !important;">
              <h3 style="margin-bottom: 1px !important;">PMPLand Cirebon Office</h3>
              <address style="margin-bottom: 10px !important;">Tirtayasa Regency Blok D-1, RT. 001 RW 007, Ds. Kepompongan, Kec. Talun, Kab. Cirebon, Jawa Barat 45171 </address>
              <span class="mb-2">(0231) 8820988</span>
            </div>
            <div class="widget" style="margin-bottom: 20px !important;">
              <h3 style="margin-bottom: 1px !important;">PMPLand Jakarta Office</h3>
              <address style="margin-bottom: 10px !important;">Infiniti Office, Indonesia Stock Exchange Tower 1 Level 3, Unit 304, Jl. Jendral Sudirman Kav 52-53 Jakarta Selatan 12190</address>
              <span class="mb-2">(021) 5890 5002</span>
              <ul class="list-unstyled links mt-3">
                <li>
                  <a class="linkmodf" href="mailto:pmplandcloud@gmail.com">info@pmpland.co.id</a>
                </li>
              </ul>
            </div>
            
            <ul class="list-unstyled social">
              <li>
                <a href="whatsapp://send?phone=+6281224466679"><span class="fab fa-whatsapp"></span></a>
              </li>
              <li>
                <a style="margin-left:3px;" href="https://www.tiktok.com/@pmpland?lang=en"><span class="fab fa-tiktok"></span></a>
              </li>
              <li>
                <a style="margin-left:3px;" href="https://www.instagram.com/pmpland.id/?hl=en"><span class="icon-instagram"></span></a>
              </li>
              <li>
                <a style="margin-left:3px;" href="https://www.youtube.com/channel/UCRUv3v9zgT-OAjMsAywk9mg"><span class="icon-youtube"></span></a>
              </li>
              <li>
                <a style="margin-left:3px;" href="https://www.facebook.com/pmplandofficial/"><span class="icon-facebook"></span></a>
              </li>
            </ul>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->

          <div class="col-lg-5">
            <div class="map-container" style="max-width:500px;">
              <img src="/sub-www/images/maps.jpg" alt="Peta Indonesia" class="map-image">

              <a href="https://www.google.com/maps/place/PMPLand+Group/@-6.7031049,108.5573914,159m/data=!3m1!1e3!4m14!1m7!3m6!1s0x2e6f1d3eb9b9156f:0xa5b6b0071dce659d!2sPMPLand+Group!8m2!3d-6.7032094!4d108.5577143!16s%2Fg%2F11ptlwsxs2!3m5!1s0x2e6f1d3eb9b9156f:0xa5b6b0071dce659d!8m2!3d-6.7032094!4d108.5577143!16s%2Fg%2F11ptlwsxs2?hl=en&entry=ttu&g_ep=EgoyMDI1MTAxNC4wIKXMDSoASAFQAw%3D%3D" 
                target="_blank" class="map-pin-link pin-jawa"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Cirebon Office">
                <i class="bi bi-geo-alt-fill map-pin"></i>
              </a>

              <a href="https://www.google.com/maps/place/INFINITI+OFFICE+%7C+Virtual+Office+SCBD/@-6.2235196,106.8062128,1135m/data=!3m1!1e3!4m10!1m2!2m1!1sInfiniti+Office,+Indonesia+Stock+Exchange+Tower+1+Level+3,+Unit+304,+Jl.+Jendral+Sudirman+Kav+52-53+Jakarta+Selatan+12190!3m6!1s0x2e69f316ddc2ba75:0x9d890f0514472498!8m2!3d-6.2232589!4d106.8088861!15sCnlJbmZpbml0aSBPZmZpY2UsIEluZG9uZXNpYSBTdG9jayBFeGNoYW5nZSBUb3dlciAxIExldmVsIDMsIFVuaXQgMzA0LCBKbC4gSmVuZHJhbCBTdWRpcm1hbiBLYXYgNTItNTMgSmFrYXJ0YSBTZWxhdGFuIDEyMTkwWncidWluZmluaXRpIG9mZmljZSBpbmRvbmVzaWEgc3RvY2sgZXhjaGFuZ2UgdG93ZXIgMSBsZXZlbCAzIHVuaXQgMzA0IGpsIGplbmRyYWwgc3VkaXJtYW4ga2F2IDUyIDUzIGpha2FydGEgc2VsYXRhbiAxMjE5MJIBFXZpcnR1YWxfb2ZmaWNlX3JlbnRhbJoBJENoZERTVWhOTUc5blMwVkpRMEZuU1VORWFreHlYemhSUlJBQqoB9AEKDS9nLzExdnlkbDZobTAQASpFIkFpbmZpbml0aSBvZmZpY2UgaW5kb25lc2lhIHN0b2NrIGV4Y2hhbmdlIHRvd2VyIDEgbGV2ZWwgMyB1bml0IDMwNCgmMh8QASIbU7USWR_sz_bM0XIRsPX_0lk_ECa0amub8kqxMnkQAiJ1aW5maW5pdGkgb2ZmaWNlIGluZG9uZXNpYSBzdG9jayBleGNoYW5nZSB0b3dlciAxIGxldmVsIDMgdW5pdCAzMDQgamwgamVuZHJhbCBzdWRpcm1hbiBrYXYgNTIgNTMgamFrYXJ0YSBzZWxhdGFuIDEyMTkw4AEA-gEFCJ4BEDQ!16s%2Fg%2F11vchg4hq2?entry=ttu&g_ep=EgoyMDI1MTAxNC4wIKXMDSoASAFQAw%3D%3D"
                target="_blank" class="map-pin-link pin-jakarta"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Jakarta Office">
                <i class="bi bi-geo-alt-fill map-pin"></i>
              </a>
            </div>



          </div>


            <!-- <div class="widget">


              </div> -->

            <!-- <a href="https://www.google.com/maps?ll=-6.757088,108.561632&z=17&t=m&hl=en&gl=ID&mapclient=embed&cid=11940925006630774173">
              <img src="<?php echo siteUrl();?>sub-www/images/maps.jpg" alt="Image" class="img-fluid"/>
            </a>
              <iframe class="img-thumbnail d-none" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.526173077146!2d108.56098856952153!3d-6.757086367787732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d3eb9b9156f%3A0xa5b6b0071dce659d!2sPMPLand%20Office!5e0!3m2!1sen!2sid!4v1686293506860!5m2!1sen!2sid" width="100%" style="border:0; height:250px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> -->
            <!-- /.widget -->
          </div>
        </div>
        <!-- /.row -->

        <div class="row mt-5">
          <div class="col-12 text-center">

            <p>
             © Copyright 2024 PT. PANCA MULIA PERSADA
            </p>
          </div>
        </div>
      </div>
      <!-- /.container -->
    </div>
    <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script> -->
    <script src="<?php echo siteURL(); ?>js-tiny-slider.js"></script>
    <script src="<?php echo siteURL(); ?>js-aos.js"></script>
    <script src="<?php echo siteURL(); ?>js-navbar.js"></script>
    <script src="<?php echo siteURL(); ?>js-counter.js"></script>
    <script src="<?php echo siteURL(); ?>js-custom.js"></script>
    <script>
      $(document).ready(function(){
        $(".map-pin").hide();

        $(".map-image").on("click", function(){
          $(".map-pin").fadeToggle(400);
        });
      });
    function closeMenuPopup() {
              var menuToggle = document.querySelectorAll(".js-menu-toggle");
              var mTog;
              menuToggle.forEach(mtoggle => {
                mTog = mtoggle;
                document.body.classList.remove('offcanvas-menu');
                    mtoggle.classList.remove('active');
                    mTog.classList.remove('active');
               
              })
            }
    window.addEventListener('scroll', function() {
            var scrollPosition = window.scrollY;
            var navbar = document.getElementById('scroll-nav-homemade');

            /* Menentukan nilai opacity berdasarkan posisi scroll */
              var maxOpacity = 1;
              var minOpacity = 0.7;
              var opacity = maxOpacity - (scrollPosition / 200) * (maxOpacity - minOpacity); /* Ubah angka 200 sesuai kebutuhan */

              /* Batasan opacity minimal */
              if (opacity < minOpacity) {
                opacity = minOpacity;
              }

              /* Mengubah nilai opacity navbar */
              navbar.style.opacity = opacity;
              
          });
    
    window.addEventListener('scroll', function() {
      var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
      var scrollButton = document.querySelector('.scroll-to-top-button');
      
      if (scrollPosition > 0) {
        scrollButton.style.opacity = 1;
      } else {
        scrollButton.style.opacity = 0;
      }
    });
</script>
<script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

  </body>
</html>