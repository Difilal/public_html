<?php include 'code/digital-card-download-query.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Card</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        @font-face {
            font-family: 'Druk Bold';
            src: url('<?= $baseUrl ?>sub-www/fonts/Druk/Druk-Bold-Trial.otf') format('opentype');
        }
        @font-face {
            font-family: 'Aeonik Medium';
            src: url('<?= $baseUrl ?>sub-www/fonts/Aeonik/Aeonik-Medium.otf') format('opentype');
            font-weight: 500;
            font-display: swap;
        }
        @font-face {
            font-family: 'Aeonik Bold';
            src: url('<?= $baseUrl ?>sub-www/fonts/Aeonik/Aeonik-Bold.otf') format('opentype');
            font-weight: bold;
            font-display: swap;
        }
        @font-face {
            font-family: 'Aeonik Regular';
            src: url('<?= $baseUrl ?>sub-www/fonts/Aeonik/Aeonik-Regular.otf') format('opentype');
            font-weight: normal;
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #111;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loading {
            color: #fff;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* ================= CARD ================= */
        .card {
            width: 800px;
            height: 500px;
            position: relative;
            background: #fff;
            overflow: hidden;
        }

        /* BACKGROUND IMAGE */
        .card-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        /* TEXT LAYER */
        .overlay {
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
        }

        /* ================= NAME ================= */
        .identity {
            position: absolute;
            top: 185px;
            left: 85px;
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 6px; /* jarak name & jabatan */
        }

        .name {
            font-family: 'Aeonik Bold', sans-serif;
            font-size: 40px;
            color: #1F1F1F;
            line-height: 1.0;
            white-space: normal;
            
            transform: scaleX(1.2);
            word-break: break-word;
        }

        .position {
            font-family: 'Aeonik Regular', sans-serif;
            font-size: 21px;
            color: #DA1F26;
            transform: scaleX(1.2);
        }

        /* ================= OFFICE ================= */
        .office {
            position: absolute;
            bottom:45px;
            right: 356px;
            max-width: 280px;
            text-align: left;
        }

        .office-label {
            font-family: 'Aeonik Medium', sans-serif;
            font-size: 19px;
            font-weight: 700;
            color: #1F1F1F;
        }

        .office-text {
            font-family: 'Aeonik Reguler', sans-serif;
            font-size: 19px;
            line-height: 1.25;
            color: #333;
        }

        /* ================= CONTACT ================= */
        .contact {
            position: absolute;
            bottom:50px;
            right: 35px;
            max-width: 280px;
            text-align: left;
        }

        .contact-label {
            font-family: 'Aeonik Medium', sans-serif;
            font-size: 19px;
            font-weight: 700;
            color: #1F1F1F;
        }

        .contact-item {
            font-family: 'Aeonik Reguler', sans-serif;
            font-size: 19px;
            line-height: 1.25;
            color: #333;
        }

        .contact-website {
            font-family: 'Aeonik Medium', sans-serif;
            font-size: 19px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #1F1F1F;
            margin-top: -5px;
        }
    </style>
</head>

<body>

<div class="loading" id="loadingText">Generating image...</div>

<div class="card" id="businessCard">

    <!-- BACKGROUND TEMPLATE -->
    <img 
        src="<?= $baseUrl ?>sub-www/images/design-id-card-2.png"
        class="card-bg"
        alt="PMPLand Template"
        crossorigin="anonymous"
    >

    <!-- DATA OVERLAY -->
    <div class="overlay">

        <!-- NAME -->
         <div class="identity">
            <div class="name"><?= $nama ?></div>
            <div class="position"><?= $jabatan ?></div>
        </div>
        <!-- <div class="name"><?= $nama; ?></div>
        <div class="position"><?= strtoupper($jabatan); ?></div> -->

        <div class="office">
            <div class="office-label">HEAD OFFICE</div>
            <div class="">
                <span class="office-text">
                    <?= $alamat_line1; ?><br>
                </span>
                <span class="office-text">
                    <?= $alamat_line2; ?><br>
                </span>
                <span class="office-text">
                    <?= $alamat_line3; ?>
                </span>
            </div>
        </div>

        <!-- CONTACT -->
        <div class="contact">
            <div class="contact-label">CONTACT</div>
            <div class="contact-item"><?= $email; ?></div>
            <div class="contact-item"><?= $phone; ?></div>
            <div class="contact-website"><?= $website; ?></div>
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= siteUrl(); ?>sub-www/js/js-global-auth/digital-card-download-b.js?v=<?= time(); ?>"></script>

</body>
</html>
