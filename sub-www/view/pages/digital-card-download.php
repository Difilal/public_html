<?php include 'code/digital-card-download-query.php' ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Business Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        @font-face {
            font-family: 'Druk Bold';
            src: url('<?= $baseUrl ?>sub-www/fonts/Druk/Druk-Bold-Trial.otf') format('opentype');
            font-weight: bold;
            font-display: swap;
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

        * { margin: 0; padding: 0; box-sizing: border-box; }


        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #1a1a1a;
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
        .card {
            width: 700px;
            height: 400px;
            background: #111111;
            padding: 45px 50px;
            position: relative;
            color: #fff;
        }
        .name {
            font-family: 'Druk Bold', sans-serif;
            font-size: 56px;
            font-weight: 800;
            color: #DA1F26;
            white-space: nowrap;
            overflow: hidden;
        }
        .position {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            color: white;
            font-weight: 600;
            margin-bottom: 35px;
            white-space: nowrap;
            overflow: hidden;
        }
        .contact-label {
            font-family: 'Aeonik Medium', sans-serif;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #fff;
        }
        .contact-item {
            font-family: 'Aeonik Reguler', sans-serif;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .cd-contact-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .cd-contact-row svg {
            width: 24px;
            height: 24px;
            margin-right: 14px;
            flex-shrink: 0;
        }
        .cd-contact-row span {
            font-family: 'Aeonik Regular', sans-serif;
            font-size: 16px;
            color: #FFFFFF;
        }

        .contact-icon {
            width: 22px;
            height: 22px;
            border-radius: 4px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
        }
        .icon-email { background: #fff; color: #111; }
        .icon-wa { background: #25D366; color: #fff; }

        /* Bottom Section - Logo kiri, Address kanan */
        .bottom-section {
            position: absolute;
            bottom: 35px;
            left: 50px;
            right: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .logo-section {
            display: flex;
            align-items: center;
        }
        .logo-img {
            height: 55px;
            width: auto;
        }
        .right-section {
            text-align: right;
        }
        .office-label {
            font-family: 'Aeonik Medium', sans-serif;
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 0px;
            text-align: left;
        }
        .address {
            font-family: 'Aeonik Regular', sans-serif;
            font-size: 14px;
            color: white;
            line-height: 1.6;
            margin-bottom: 12px;
            text-align: left;
        }
        .website {
            text-align: left;
            font-family: 'Aeonik Medium', sans-serif;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="loading" id="loadingText">Generating image...</div>

    <div class="card" id="businessCard">
        <!-- Top: Name & Position -->
        <div class="name"><?php echo $nama; ?></div>
        <div class="position"><?php echo $jabatan; ?></div>

        <!-- Middle: Contact -->
        <div class="contact-label">Contact</div>
        <div class="contact-item cd-contact-row">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="4" width="20" height="16" rx="2" stroke="white" stroke-width="1.5"/>
                <path d="M2 4L12 13L22 4" stroke="white" stroke-width="1.5"/>
            </svg>
            <span><?php echo $email; ?></span>
        </div>
        <div class="contact-item cd-contact-row">
            <svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            <span><?php echo $phone; ?></span>
        </div>

        <!-- Bottom: Logo (left) & Address (right) -->
        <div class="bottom-section">
            <div class="logo-section">
                <img src="<?php echo $logoUrl; ?>" alt="PMPLand" class="logo-img" crossorigin="anonymous">
            </div>
            <div class="right-section">
                <div class="office-label">HEAD OFFICE</div>
                <div class="address">
                    <?php echo $alamat_line1; ?><br>
                    <?php echo $alamat_line2; ?><br>
                    <?php echo $alamat_line3; ?>
                </div>
                <div class="website"><?php echo $website; ?></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?php echo siteUrl();?>sub-www/js/js-global-auth/digital-card-download.js?v=<?= time() ?>"></script>
</body>
</html>