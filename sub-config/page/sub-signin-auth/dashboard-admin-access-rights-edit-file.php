<?php

$idaccess = $_POST["idaccess"]??-1;
if($idaccess<1) echo "idaccess tidak valid";
else
{
    $ar=getData("sys_hak_akses_utama","idaccess='".escStringDB($idaccess)."'");
    ?>
    
    
    <div class="row u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">Pathdir <span style="float:right;">:</span></div>
        <div class="col-9 u-bg-secondary u-pl-zero"><?php echo $ar["pathdir"]; ?></div>
    </div>
    <div class="row u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">Filename <span style="float:right;">:</span></div>
        <div class="col-9 u-bg-secondary u-pl-zero"><?php echo $ar["filename"]; ?></div>
    </div>
    
    
    <?php
    
    $fullpathfile=$ar["pathdir"].$ar["filename"].".php";
    if(!file_exists($fullpathfile))
    {
        ?><button class="btn btn-danger mt-3 w-100 hapus-file-access-rights" id="hapusFileAccessRights<?php echo $ar["idaccess"]; ?>" idaccess=<?php echo $ar["idaccess"]; ?>>Hapus</button><?php
    }
    else
    {
        $modul=getData("sys_hak_akses_modul","idmodul='".escStringDB($ar["idmodul"])."'");
        ?>

        <div class="row mt-4 u-text-small">
            <div class="col-3">
                Modul <span style="float:right;">:</span>
            </div>
            <div class="col-9 u-pl-zero">
                <div class="input-group">
                    <input type="text" id="modulAccessRights" class="form-control form-control-sm" value="<?php echo $modul["nama_modul"]??""; ?>"> 
                    <div class="input-group-append">
                        <button class="btn btn-light btn-sm border clear-value" elm="#modulAccessRights"><i class="fas fa-times-circle"></i></button>
                    </div>
                </div>

                <textarea class="d-none" id="autotext_modulAccessRights"><?php

                $qry       = "SELECT DISTINCT nama_modul FROM sys_hak_akses_modul";
                $submodul  = getData($qry,"","all")["data"]; $x=array();
                foreach($submodul AS $v){ array_push($x,$v["nama_modul"]); }

                echo json_encode($x);
                
                ?></textarea>
            </div>
        </div>
        <div class="row mt-1 u-text-small">
            <div class="col-3">
                Sub Modul <span style="float:right;">:</span>
            </div>
            <div class="col-9 u-pl-zero">
                
                <div class="input-group">
                    <input type="text" id="submodulAccessRights" class="form-control form-control-sm" value="<?php echo $modul["sub_modul"]??""; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-light btn-sm border clear-value" elm="#submodulAccessRights"><i class="fas fa-times-circle"></i></button>
                    </div>
                </div>
                <textarea class="d-none" id="autotext_submodulAccessRights"><?php

                $qry        = "SELECT DISTINCT sub_modul FROM sys_hak_akses_modul";
                $submodul   = getData($qry,"","all")["data"]; $x=array();
                foreach($submodul AS $v){ array_push($x,$v["sub_modul"]); }

                echo json_encode($x);
                
                ?></textarea>
            </div>
        </div>
        <div class="row mt-3 u-text-small">
            <div class="col-3">
                <button class="c-btn c-btn--secondary w-100 px-1" id="nonmodulFileAccessRights" idaccess="<?php echo $ar["idaccess"]; ?>">Non Modul</button>
            </div>
            <div class="col-9 u-pl-zero">
                <button class="c-btn c-btn--info w-100" id="editFileAccessRights" idaccess="<?php echo $ar["idaccess"]; ?>">Simpan</button>
            </div>
        </div>

        <?php
    }


}