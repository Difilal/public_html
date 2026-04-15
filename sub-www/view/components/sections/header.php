<?php
// Default nilai jika tidak diberikan
$heading        = $heading ?? '';
$description    = $description ?? '';
$url1           = $url1 ?? '';
$url2           = $url2 ?? '';
?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 header-content-text">
                <div class="header-text py-5">
                    <h1 class="display-4"><?= htmlspecialchars($heading); ?></h1>
                    <p class="lead mb-4"><?= htmlspecialchars($description); ?></p>
                    <div class="header-action">
                        <?php if($url2!='') { ?>
                        <a href="<?= htmlspecialchars($url2); ?>" class="btn btn-custom-secondary">Secondary</a>
                        <?php } if($url1!='') { ?>
                        <a href="<?= htmlspecialchars($url1); ?>" class="btn btn-custom-primary">Primary<i class="fas fa-long-arrow-alt-right ms-2"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 header-content-image">
                <!-- default ilustration -->
                <svg class="_ilust-object-cirebon" viewbox="0 0 600 400" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#a)"><path d="M341.377 328.032c-10.818-4.371-45.436-41.528-60.581-89.614-12.116-38.469-38.224-62.657-49.763-69.943 19.04-15.737 39.666-3.643 47.599 4.372l1.546-.176c18.525-2.104 29.73-3.377 65.526 26.404 29.425 24.48 52.648 21.857 60.581 17.486-6.924 13.988-30.29 16.028-41.109 15.3 0 0 7.766 16.285 39.763 34.754M535 231.861c0 19.858-87.034 28.539-130.061 34.754m0 0c-31.281 4.518-39.302 7.732 26.291 12.989-10.195-4.33-18.891-8.718-26.291-12.989zM288.425 400l-79.696-54.418c-34.392-23.484-54.965-62.453-54.965-104.113v-65.93l3.51 16.608a148.684 148.684 0 0 0 42.491 76.505l1.67 1.605a148.65 148.65 0 0 0 19.126 15.532L387.824 400m-29.884 0L140.421 251.415C93.23 219.179 65 165.687 65 108.501V18l4.817 22.798a204.127 204.127 0 0 0 58.303 105.017l2.292 2.202a203.933 203.933 0 0 0 26.243 21.321l273.502 186.827A129.064 129.064 0 0 1 470.153 400" stroke="#DE0000" stroke-width="2"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h600v400H0z"/></clipPath></defs></svg>
            </div>
        </div>
    </div>
</header>