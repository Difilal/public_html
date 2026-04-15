<?php include 'code/digital-card-query.php' ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="description" content="Digital Business Card - <?php echo $nama; ?> - <?php echo $jabatan; ?> - PMPLand Group">
<title><?php echo $nama; ?> - Digital Card | PMPLand</title>

<link rel="icon" href="<?php echo $baseUrl; ?>img-logo-pmpland-2023-05.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
@font-face {
    font-family: 'Druk Bold';
    src: url('<?php echo $baseUrl; ?>sub-www/fonts/Druk/Druk-Bold-Trial.otf') format('opentype');
    font-weight: bold;
    font-display: swap;
}

@font-face {
    font-family: 'Aeonik Medium';
    src: url('<?php echo $baseUrl; ?>sub-www/fonts/Aeonik/Aeonik-Medium.otf') format('opentype');
    font-weight: 500;
    font-display: swap;
}

@font-face {
    font-family: 'Aeonik Bold';
    src: url('<?php echo $baseUrl; ?>sub-www/fonts/Aeonik/Aeonik-Bold.otf') format('opentype');
    font-weight: bold;
    font-display: swap;
}

@font-face {
    font-family: 'Aeonik Regular';
    src: url('<?php echo $baseUrl; ?>sub-www/fonts/Aeonik/Aeonik-Regular.otf') format('opentype');
    font-weight: normal;
    font-display: swap;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 95vh;
    display: flex;
    justify-content: center;
    padding: 20px 10px;
}

.card-container {
    width: 100%;
    max-width: 420px;
    background: #fff;
    border-radius: clamp(16px, 5vw, 20px);
    box-shadow: 0 10px 40px rgba(0,0,0,.08);
    overflow: hidden;
    padding: clamp(16px, 5vw, 20px);
}

/* ===== PROFILE ===== */
.profile-section {
    text-align: center;
    padding: clamp(12px, 4vw, 18px) clamp(15px, 5vw, 25px) 0;
}

.profile-photo {
    width: clamp(120px, 35vw, 150px);
    height: clamp(120px, 35vw, 150px);
    border-radius: 50%;
    object-fit: cover;
    filter: grayscale(100%);
    margin-bottom: clamp(8px, 2vw, 12px);
}

/* AUTO SCALE – RESPONSIVE */
.profile-name {
    font-family: 'Druk Bold', sans-serif;
    font-size: clamp(35px, 10vw, 51px);
    color: #D81F26;
    line-height: 1.1;
    word-wrap: break-word;
    max-width: 100%;
}

.profile-title {
    font-family: 'Aeonik Medium', sans-serif;
    font-size: clamp(13px, 3.8vw, 18px);
    color: #000000;
    line-height: 1.3;
    word-wrap: break-word;
    max-width: 100%;
    margin-top: 0px;
    margin-bottom: 20px;
}

/* ===== DOWNLOAD BUTTON ===== */
.download-btn {
    display: block;
    width: 98%;
    margin: clamp(10px, 3vw, 15px) auto 0;
    padding: clamp(14px, 4vw, 18px) clamp(18px, 5vw, 24px);
    background: #000;
    color: #fff;
    font-weight: 600;
    font-size: clamp(13px, 3.5vw, 15px);
    border-radius: clamp(20px, 6vw, 25px);
    text-decoration: none;
    text-align: center;
    transition: .3s ease;
}

.download-btn:hover {
    background: #333;
    transform: translateY(-2px);
}

/* ===== CONTACT ===== */
.contact-section {
    padding: 0 clamp(15px, 5vw, 25px);
    margin-top: 10px;
}

.contact-item {
    display: flex;
    align-items: center;
    background: #f5f5f5;
    border-radius: clamp(10px, 3vw, 12px);
    padding: clamp(8px, 2.5vw, 12px);
    margin-bottom: clamp(5px, 1.5vw, 8px);
    text-decoration: none !important;
    color: black;
    transition: .3s ease;
}

.contact-item:hover {
    background: #eee;
}

.contact-icon {
    width: clamp(36px, 10vw, 42px);
    height: clamp(36px, 10vw, 42px);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    margin-right: clamp(10px, 3vw, 14px);
    flex-shrink: 0;
    font-size: clamp(14px, 4vw, 18px);
}

.phone { background:#25D366; }
.email { background:#0B88F9; }
.website { background:#F5C228; }
.location { background:#D81F26; }

.contact-info {
    flex: 1;
    min-width: 0;
}

.contact-label {
    font-family: 'Aeonik Bold', sans-serif;
    font-size: clamp(12px, 2.8vw, 14px);
    font-weight: bold;
    line-height: 1.2;
}

.contact-value {
    font-family: 'Aeonik Regular', sans-serif;
    font-size: clamp(12px, 3.5vw, 15px);
    word-break: break-word;
    line-height: 1.3;
}

.contact-arrow {
    margin-left: clamp(6px, 2vw, 10px);
    color: #999;
    width: clamp(14px, 4vw, 18px);
    height: clamp(14px, 4vw, 18px);
}

.contact-arrow img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* ===== FOOTER ===== */
.footer-section {
    text-align: center;
    padding: clamp(12px, 4vw, 18px);
    margin-top: clamp(8px, 2vw, 12px);
}

.footer-logo {
    height: clamp(35px, 10vw, 45px);
    margin-bottom: clamp(6px, 2vw, 8px);
}

.footer-copyright {
    font-size: clamp(9px, 2.5vw, 11px);
    color: #999;
    line-height: 1.3;
}

/* ===== RESPONSIVE BREAKPOINTS ===== */
@media (max-width: 360px) {
    .profile-photo {
        width: clamp(100px, 30vw, 130px);
        height: clamp(100px, 30vw, 130px);
    }

    .profile-section {
        padding: 10px 15px 0;
    }

    .download-btn {
        font-size: clamp(12px, 3.5vw, 14px);
        padding: clamp(12px, 4vw, 16px) clamp(16px, 5vw, 20px);
    }
}

@media (min-width: 361px) and (max-width: 420px) {
    .profile-photo {
        width: clamp(130px, 35vw, 150px);
        height: clamp(130px, 35vw, 150px);
    }
}
</style>
</head>

<body>
<div class="card-container">

    <div class="profile-section">
        <?php /* $fotoPath = 'sub-www/images/irfan.jpg'; */ ?>
        <img src="<?= $foto ?>" class="profile-photo" alt="<?php echo $nama; ?>">

        <h1 class="profile-name" title="<?php echo $nama_asli; ?>"><?php echo $nama; ?></h1>
        <p class="profile-title"><?php echo $jabatan; ?></p>

        <!-- <a href="<?= $url_idcard ?>" class="download-btn" target="_blank"> -->
        <a href="<?= $baseUrl.$url_download ?><?= $data_karyawan['iduser_random'] ?>" class="download-btn" target="_blank">
            Download Business Card
        </a>
    </div>

    <div class="contact-section">

        <?php if($phone): ?>
        <a href="tel:<?php echo $phone; ?>" class="contact-item">
            <div class="contact-icon phone"><i class="fas fa-phone"></i></div>
            <div class="contact-info">
                <div class="contact-label">Phone</div>
                <div class="contact-value"><?php echo $phone; ?></div>
            </div>
            <div class="contact-arrow"><img src="<?php echo $baseUrl; ?>sub-www/images/arrow-up-right.svg" alt="" style="color: #333"></div>
        </a>
        <?php endif; ?>

        <?php if($email): ?>
        <a href="mailto:<?php echo $email; ?>" class="contact-item">
            <div class="contact-icon email"><i class="fas fa-envelope"></i></div>
            <div class="contact-info">
                <div class="contact-label">Email</div>
                <div class="contact-value"><?php echo $email; ?></div>
            </div>
            <div class="contact-arrow"><img src="<?php echo $baseUrl; ?>sub-www/images/arrow-up-right.svg" alt="" style="color: #333"></div>
        </a>
        <?php endif; ?>

        <a href="https://<?php echo $website; ?>" target="_blank" class="contact-item">
            <div class="contact-icon website"><i class="fas fa-globe"></i></div>
            <div class="contact-info">
                <div class="contact-label">Website</div>
                <div class="contact-value"><?php echo $website; ?></div>
            </div>
            <div class="contact-arrow"><img src="<?php echo $baseUrl; ?>sub-www/images/arrow-up-right.svg" alt="" style="color: #333"></div>
        </a>

         <a href="<?= $urlGMaps ?>" class="contact-item" target="_blank">
            <div class="contact-icon location">
                <i class="fas fa-location-dot"></i>
            </div>
            <div class="contact-info">
                <div class="contact-label">Head Office</div>
                <div class="contact-value" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:92%;"><?php echo $alamat; ?></div>
            </div>
            <div class="contact-arrow">
                <img src="<?php echo $baseUrl; ?>sub-www/images/arrow-up-right.svg" alt="" style="color: #333">
            </div>
        </a>
    </div>

    <div class="footer-section">
        <img src="<?php echo $baseUrl; ?>sub-www/images/logo/PMPLand-GROUP LOGO-BLACK-02.png" class="footer-logo">
        <p class="footer-copyright">
            &copy;<?php echo date('Y'); ?> PMPLANDGROUP
        </p>
    </div>

</div>

<script>
function adjustFontSize() {
    const profileName = document.querySelector('.profile-name');
    const profileTitle = document.querySelector('.profile-title');
    const contactValues = document.querySelectorAll('.contact-value');

    function checkAndAdjust(element, minSize) {
        if (!element) return;

        const lineHeight = parseFloat(window.getComputedStyle(element).lineHeight);
        const actualHeight = element.scrollHeight;
        const lines = Math.round(actualHeight / lineHeight);

        // Check if wraps to 2+ lines
        if (lines > 1) {
            const currentSize = parseFloat(window.getComputedStyle(element).fontSize);
            const reductionFactor = Math.min(0.85, 1 - ((lines - 1) * 0.15));
            const newSize = Math.max(minSize, currentSize * reductionFactor);
            element.style.fontSize = newSize + 'px';
        }
    }

    function checkContactValue(element, minSize) {
        if (!element) return;

        const parent = element.closest('.contact-info');
        if (!parent) return;

        // Reset font size first to check natural size
        element.style.fontSize = '';

        const lineHeight = parseFloat(window.getComputedStyle(element).lineHeight);
        const actualHeight = element.scrollHeight;
        const lines = Math.round(actualHeight / lineHeight);
        const parentWidth = parent.offsetWidth;
        const elementWidth = element.scrollWidth;

        // Check if wraps to 2+ lines or overflows parent width
        if (lines > 1 || elementWidth > parentWidth) {
            const currentSize = parseFloat(window.getComputedStyle(element).fontSize);
            let reductionFactor = 0.85;

            // More aggressive reduction if severely overflowing
            if (lines > 2 || elementWidth > parentWidth * 1.2) {
                reductionFactor = 0.75;
            }

            const newSize = Math.max(minSize, currentSize * reductionFactor);
            element.style.fontSize = newSize + 'px';
        }
    }

    // Adjust profile elements
    checkAndAdjust(profileName, 24);
    checkAndAdjust(profileTitle, 11);

    // Adjust contact values
    contactValues.forEach(contactValue => {
        checkContactValue(contactValue, 10);
    });
}

window.addEventListener('load', adjustFontSize);
window.addEventListener('resize', adjustFontSize);
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?php echo $baseUrl; ?>sub-www/js/js-global-auth/digital-card.js"></script>
</body>
</html>
