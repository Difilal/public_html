<div class="row justify-content-center">
      <?php if(!empty($data)) {?>
        <div class="col-sm-8">
          <div class="justify-content-start">
            <h3 class="text-center text-muted"><?= $data["judul_artikel"]; ?></h3> 
            <p style="font-size: 15px; font-weight: bold;" class="text-center">
              <span class="badge badge-pill" 
                style="
                  background-color: <?= $data["warna"];?>; 
                  color: <?= isCloseToWhite($data["warna"]) ? "black" : "white"; ?>; 
                  <?= isCloseToWhite($data["warna"]) ? 'border: 1px solid black;' : '' ?>
                ">
                <?= $data["kategori"]?>
              </span>
            </p>
            <p class="text-center text-muted" style="margin-top:15px"><b><?= "PMPLAND" ?></b></p> 
            <p class="text-muted text-center" style="margin-top:-15px"><small><?= FormatTglWaktu(setTglUTC($data['tgl_publish'], "+00:00", $data["utc_offset"]),["tgl"=>"3digit-id","waktu"=>"JamMenit"]) ?></small></p>
            <p class="text-muted text-center" style="margin-top:-15px"><small><i class="fas fa-eye"></i> <?= $data["total_visitor"] ?> view</small></p>
            <div class="image-container">
              <img class="card-image img-fluid zoom-image card" style="background: #212C3C;" src="<?php echo $data["header_konten"]; ?>">
            </div>
          </div>
          <div class="justify-content-start mt-4">
            <?= $data["konten"] ?>
          </div>
          <?php include("share-button.php");?>
        </div>
      <?php }else{ ?>
        <div class="col-sm-12">
          <div class="justify-content-start">
            <h4 class="border-bottom pb-2">Saat ini, artikel belum tersedia</h4>
          </div>
        </div>
      <?php }?>
    </div>