<div class="site-mobile-menu site-navbar-target" >
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<nav class="site-nav" style="padding-top:0px !important; ">
    <div class="container">
      <div id="scroll-nav-homemade" class="menu-bg-wrap" style="background-color: transparent !important; padding: 12px 20px !important;">
        <div class="site-navigation">
          <a href="<?php echo siteUrl(); ?>" class="logo m-0 float-start">
          <img style="width:140px;" src="<?php echo siteUrl();?>sub-www/images/logo/PMPLand-GROUPLOGO-WHITE-FINAL.png" class="img-responsive" alt="PMPLAND">
        </a>
        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
          <?php if($_SESSION['modpage'] = 'proyek'){ ?>
          <li class="active"><a class="menu-link" href="<?php echo siteUrl(); ?>">Beranda</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#profiles">Tentang Kami</a></li>
          <!-- <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#proyek">Proyek</a></li> -->
           <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>proyek-perumahan/#proyek">Proyek</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#artikel">Artikel</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#karir">Karir</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#site-footer">Hubungi Kami</a></li>
          <?php }else{ ?>
          <li class="active"><a class="menu-link" href="<?php echo siteUrl(); ?>">Beranda</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#profiles">Tentang Kami</a></li>
          <!-- <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#proyek">Proyek</a></li> -->
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>proyek-perumahan/#proyek">Proyek</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#artikel">Artikel</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#karir">Karir</a></li>
          <li class="active"><a class="menu-link" onclick="closeMenuPopup()" href="<?php echo siteUrl();?>#site-footer">Hubungi Kami</a></li>
          <?php } ?>
        </ul>
        <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
            <br>
          </a>
        </div>
      </div>
    </div>
  </nav>

  