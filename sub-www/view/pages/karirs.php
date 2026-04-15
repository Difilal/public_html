<?php 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$limit = 12; 
$offset = ($page - 1) * $limit;

$totalQuery = "SELECT COUNT(*) as total FROM web_artikel WHERE status_artikel = 1 AND idkategori = 1";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalKarirs = $totalRow['total'];
$totalPages = ceil($totalKarirs / $limit);

$query_karir = "SELECT wa.idartikel, wa.konten, wa.judul_artikel, wa.tgl_publish, wa.header_konten, wa.idkategori, wk.warna, wk.kategori
                  FROM web_karir AS wa 
                  LEFT JOIN web_kategori_karir AS wk ON wa.idkategori = wk.idkategori
                  WHERE wa.status_artikel = 1 AND wa.idkategori = 1
                  ORDER BY wa.tgl_publish DESC 
                  LIMIT $limit OFFSET $offset";
$data = getData($query_karir, "", "all")["data"];
?>

<?php include('header-artikel.php');?>

<div class="section sec-testimonials" id="main-karir-all">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3 class="heading" style="font-family: 'AeonikAir' !important;">Karir <br><br></h3>
      </div>
    </div>
    <div class="row justify-content-center">
      <?php if (!empty($data)) { ?>
        <?php foreach ($data as $d) { ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 d-flex">
            <div class="card flex-fill text-left img zoom-container ">
                <div class="card-body d-flex flex-column">
                  <a target="_blank" href='<?php echo siteUrl() . "karir/" ."lowongan-kerja-".sanitizeString($d["judul_artikel"], $d["idartikel"])?>' >
                  <div class="image-container">
                    <img class="card-image img-fluid zoom-imageartikel " style="background: #212C3C;" src="<?php echo $d["header_konten"]; ?>">
                  </div>
                  <p class="card-subtitle mt-2 text-muted"><small> <?= FormatTgl($d['tgl_publish'],"3digit-id") ?> </small></p>
                  <span class="badge badge-pill" 
                    style="
                      background-color: <?= $d["warna"];?>; 
                      color: <?= isCloseToWhite($d["warna"]) ? "black" : "white"; ?>; 
                      <?= isCloseToWhite($d["warna"]) ? 'border: 1px solid black;' : '' ?>
                    ">
                    <?= $d["kategori"]?>
                  </span>
                  <p style="font-size: 15px; font-weight: bold;" class="card-title mt-1"> 
                    <?= $d["judul_artikel"] ?> 
                  </p>
                  </a>
                </div>
              </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <p class="text-black-50 text-center">Saat ini, belum tersedia lowongan</p>
      <?php } ?>
    </div>

    <nav aria-label="Page navigation example" class="mt-4">
      <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="/karir/page/<?= $page - 1 ?>#karir" tabindex="-1"
            aria-disabled="true">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
          <a class="page-link" href="/karir/page/<?= $i ?>#karir"><?= $i ?></a>
        </li>
        <?php } ?>

        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
          <a class="page-link" href="/karir/page/<?= $page + 1 ?>#karir">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<script src="<?php echo siteUrl();?>sub-www/js/js-global-auth/commonJS.js?v=<?= time() ?>"></script>
