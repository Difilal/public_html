<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />

    <meta name="google-site-verification" content="H9f8HzoWWznqjKL0x1Pu3tgM7q4h1ku_Jc3Gqoew7b0" />
    <!-- <link rel="shortcut icon" href="http://sip.pmpland.abc/img-logo-pmpland-2023-05.png" /> -->
    <link rel="icon" href="<?php echo siteUrl();?>img-logo-pmpland-2023-05.png" type="image/png" sizes="16x16">

    <meta name="description" content="PMPLand, PT. Panca Mulia Persada, perusahaan pengembang perumahan subsidi dan komersil, terbaik dan terbesar sewilayah 3 Cirebon." />
    <meta name="keywords" content="pmpland, perumahan subsidi, perumahan, proyek perumahan, perumahan cirebon, perumahan murah" />

    <meta property="og:title" content="<?= htmlspecialchars($data['judul_artikel']) ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($data['meta_description']) ?>" />
    <meta property="og:image" content="<?= $data['header_konten'] ?>" />
    <meta property="og:url" content="https://pmpland.co.id/artikel/<?= $data['slug'] ?>" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $data['judul_artikel'] ?>" />
    <meta name="twitter:description" content="<?= $data['meta_description'] ?>" />
    <meta name="twitter:image" content="<?= $data['header_konten'] ?>" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <link rel="stylesheet" href="<?php echo siteURL(); ?>sub-www/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="<?php echo siteURL(); ?>sub-www/fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="<?php echo siteURL(); ?>sub-www/css/tiny-slider.css" />
    <link rel="stylesheet" href="<?php echo siteURL(); ?>sub-www/css/aos.css" />
    <link rel="stylesheet" href="<?php echo siteURL(); ?>sub-www/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-HN05KLZ4PH"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-HN05KLZ4PH');
    </script>


<link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />

    <style>
      body *:not(.icon):not(.fa):not(.fab):not(.fas):not(.vjs-icon-play):not(.video-js .vjs-play-control .vjs-icon-placeholder:before, .video-js .vjs-big-play-button .vjs-icon-placeholder:before)  {
        font-family: 'AeonikAir';
      }
      .Aeonik {
        font-family: 'AeonikAir' !important;
      }
      .linkmodf{
        text-decoration: none !important;
      }
      .zoom-containerartikel {
        position: relative;
        overflow: hidden;
      }
      .zoom-container {
        position: relative;
        display: inline-block;
        overflow: hidden;
      }
      .zoom-image {
        transition: transform 0.3s ease;
      }

      .zoom-container:hover .zoom-image {
        transform: scale(1.2);
      }

      .zoom-imageartikel {
        transition: transform 0.3s ease;
      }

      .zoom-container:hover .zoom-imageartikel {
        transform: scale(1.05);
      }
      .ytxtproyekslide{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        text-align: center;
        width: 60%;
      }
      
      .ytxtproyekslide2{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        text-align: center;
        font-size:12px;
        width: 70%;
      }
      .ytxtproyekdetail{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        text-align: center;
        width: 60%;
      }
      .whatsapp-button {
        position: fixed;
        bottom: 20px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        /*background-color: #25D366;*/
        color: #fff;
        text-align: center;
        font-size: 24px;
        line-height: 60px;
        z-index: 9999;
      }
      .scroll-to-top-button {
        position: fixed;
        bottom: 20px;
        left: 30px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        border:1px solid grey;
        color: black;
        text-align: center;
        font-size: 24px;
        line-height: 50px;
        z-index: 9999;
        cursor: pointer;
        transition: opacity 0.3s;
        opacity: 0;
      }
        .menu-link {
          display: inline-block;
          position: relative;
          text-decoration: none;
          color: inherit;
          font-family: "AeonikAir" !important;
        }

        .menu-link::after {
          content: '';
          position: absolute;
          bottom: -2px;
          left: 50%;
          transform: translateX(-50%);
          width: 50%;
          height: 1px;
          background-color: yellow;
          visibility: hidden;
          opacity: 0;
          transition: visibility 0s, opacity 0.3s ease-in-out;
        }

        .menu-link:hover::after {
          visibility: visible;
          opacity: 1;

        }
        .image-container {
          width: 100%;
          padding-top: 56.25%; /* Untuk rasio 16:9 */
          position: relative;
          overflow: hidden;
          background: #212C3C;
        }

        .card-image {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          object-fit: cover;
        }

        /* Add this to your stylesheet */

        /* Base styling for sections that will have the hover effect */
        .section {
          position: relative;
          overflow: hidden;
        }

        /* The animated underline that will appear on hover */
        .section::after {
          content: '';
          position: absolute;
          bottom: 0;
          left: 0;
          width: 0;
          height: 1px; /* Thinner line for more elegance */
          background-color: rgba(219, 0, 0, 0.7); /* Semi-transparent red for subtlety */
          transition: width 0.5s ease-in-out;
          visibility: hidden;
        }

        /* When section is hovered, make the line visible and animate from left to right */
        .section:hover::after {
          visibility: visible;
          width: 100%;
        }

        /* You may need to adjust specific sections if they have padding/margins at the bottom */
        .section.bg-light::after,
        .section.section-4::after,
        .section.section-5::after,
        .section.sec-testimonials::after {
          bottom: 0;
        }


      

        /* Optional: you can also add a subtle box-shadow for more emphasis */
        .card.flex-fill:hover {
          box-shadow: 0 0.5px 2px rgba(219, 0, 0, 0.7);
        }
      </style>
      <style>
      @font-face {
          font-family: "AeonikAir";
          src: url("<?php echo siteURL(); ?>sub-www/fonts/Aeonik/Aeonik-Regular.otf?10si43") format("opentype");
      }
      </style>
    <title>
      PMPLand
    </title>
  </head>
  <body id="homes" class="Aeonik" >
  <!--<a href="whatsapp://send?phone=+6281224466679" class="whatsapp-button" target="_blank">
  <img src="<?php echo siteUrl();?>sub-www/images/wa.gif" alt="Image" class="img-fluid"/>
  <i class="fab fa-whatsapp"></i>
    WhatsApp
  </a>-->
  <a href="whatsapp://send?phone=+6281224466679" class="whatsapp-button" target="_blank">
  <img src="<?php echo siteUrl();?>sub-www/images/wa.gif" alt="Image" class="img-fluid"/>
  </a>
  <a href="#" class="scroll-to-top-button">
    ^
  </a>
  