<?php
extract($data);
// Default nilai jika tidak diberikan
$description = $description ?? '';
$copy = $copy ?? '';
?>

<div class="hero">
    <div class="container text-center py-5">
        <h3 class="display-5 fw-normal text-danger"><?= $description; ?></h3>
        <!-- <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
        <span class="copy text-muted" style="font-size: small;"><?= $copy; ?></span>
    </div>
</div>