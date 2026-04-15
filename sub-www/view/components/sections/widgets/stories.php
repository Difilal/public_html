<?php
extract($data);
// Default nilai jika tidak diberikan
$table = $table ?? 'web_cerita';
$contentType = $contentType ?? 'card';
$contentViewRow = $contentViewRow ?? 0;
$contentViewColumn = $contentViewColumn ?? 0;
$enableViewMore = $enableViewMore ?? true;
$contentViewLimit = $contentViewRow*$contentViewColumn;

$highlightStories = getDataHighlightKonten('web_cerita', ['idcerita', 'judul_cerita', 'slug_cerita', 'tgl_input'], $contentViewLimit);
?>

<?php if($contentType=="slide") { ?>
<section class="section">
    <div class="container py-5">
        <div class="d-block-with-blob h-100" id="blockBlobStories">
            <div class="d-block-bg"></div>
            <div class="d-block-content">
                <div class="row">
                    <div class="col w-100">
                        <div class="d-heading-content">
                            <h2 class="text-danger fw-normal">Journeys</h2>
                        </div>
                    </div>
                    <div class="col-auto d-flex">
                        <button class="btn btn-slide-nav btn-slide-nav-prev bg-light text-danger" data-swiper="swpStories"><i class="fas fa-chevron-left"></i></button>
                        <button class="btn btn-slide-nav btn-slide-nav-next bg-light text-danger" data-swiper="swpStories"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="d-body-content" id="swpStories">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php if(count($highlightStories)!=0) { foreach($highlightStories as $hs) { ?>
                            <article class="swiper-slide">
                                <div class="swiper-slide-card show-fade-in">
                                    <div class="slide-card-wrapper">
                                        <img src="https://images.unsplash.com/photo-1577645113639-32537a4a938b?q=80&w=1854&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="slide-card-image">
                                        <div class="slide-card-title">
                                            <div class="d-block mt-auto">
                                                <a href="<?= siteURL().'artikel/'.htmlspecialchars($hs['slug_cerita']).'-'.htmlspecialchars($hs['idcerita']).'?cat=stories'; ?>" class="text-decoration-none text-light fw-medium">
                                                    <h3 class="fs-5"><?= htmlspecialchars($hs['judul_cerita']); ?></h3>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <?php } } else { ?>
                            <article class="swiper-slide">
                                <div class="swiper-slide-card show-fade-in">
                                    <div class="slide-card-wrapper bg-white">
                                        <p class="position-absolute text-center" style="left: 0;top: 50%;width: 100%;transform: translateY(-1rem);">Belum ada data..</p>
                                    </div>
                                </div>
                            </article>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if($enableViewMore) { ?>
                <div class="d-action-content">
                    <a href="" class="btn btn-custom bg-light text-danger">Tampilkan lebih banyak<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php } elseif($contentType=="card") { ?>
<section class="section">
    <div class="container">
        <p class="text-center">Under development..</p>
    </div>
</section>
<?php } else { ?>
<section class="section">
    <div class="container">
        <p class="text-center">Cant find the widget (stories)..</p>
    </div>
</section>
<?php } ?>