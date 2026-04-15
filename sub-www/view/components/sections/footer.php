<?php
// Default nilai jika tidak diberikan
$copy       = $copy ?? '&copy; Copyright 2024';
$socialLink = $socialLink ?? [];
?>
<footer class="footer bg-dark">
    <div class="container">
        <div class="d-flex align-items-center py-3">
            <div class="flex-grow-1 text-white-50" style="font-size: small;"><?= htmlspecialchars($copy); ?></div>
            <div>
                <?php
                if($socialLink) { foreach($socialLink as $sl) {
                $iconSocial = "";
                if      ($sl['media']=="facebook")  {$iconSocial = "fab fa-facebook-f";}
                elseif  ($sl['media']=="instagram") {$iconSocial = "fab fa-instagram";}
                elseif  ($sl['media']=="tiktok")    {$iconSocial = "fab fa-tiktok";}
                elseif  ($sl['media']=="youtube")   {$iconSocial = "fab fa-youtube";}
                elseif  ($sl['media']=="whatsapp")  {$iconSocial = "fab fa-facebook-f";}
                ?>
                <a href="<?= $sl['data'] ?>" class="btn btn-dark text-secondary rounded-pill px-3" alt="<?= $sl['media'] ?>" target="_blank"><i class="<?= $iconSocial; ?>"></i></a>
                <?php } } ?>
            </div>
        </div>
    </div>
</footer>