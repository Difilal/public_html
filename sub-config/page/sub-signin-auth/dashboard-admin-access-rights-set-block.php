<?php


$access_rights=getData("sys_hak_akses_utama","idaccess='".escStringDB($_POST["accessRights_idaccess"])."'");

$default_access=$access_rights["default_access"];
if($default_access!="")         $default_access=json_decode($default_access,true); else $default_access="";
if(is_array($default_access))   $default_access_list="AND jabatan IN ('".join("','",$default_access)."')";
else                            $default_access_list="";

$block_access=getData("sys_hak_akses_utama","idaccess='".escStringDB($_POST["accessRights_idaccess"])."'","block_access");
if($block_access!="") $block_access=json_decode($block_access,true); else $block_access="";
if(is_array($block_access)) $block_access_list=" AND iduser NOT IN ('".join("','",$block_access)."')";
else                        $block_access_list="";


?><div class="d-block">

<input type="hidden" id="accessRights_idaccess" value="<?php if(isset($_POST["accessRights_idaccess"])) echo $_POST["accessRights_idaccess"]; ?>">



    <div class="row u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">
            Pathdir <span style="float:right;">:</span>
        </div>
        <div class="col-9 u-bg-secondary u-pl-zero">
            <?php echo $access_rights["pathdir"]; ?>
        </div>
    </div>

    <div class="row u-mb-small u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">
            Filename <span style="float:right;">:</span>
        </div>
        <div class="col-9 u-bg-secondary u-pl-zero">
            <?php echo $access_rights["filename"]; ?>
        </div>
    </div>

    <div class="row">
        <div class="col" id="accessRights_idkaryawan-wrapper">
            <select name="accessRights_idkaryawan" id="accessRights_idkaryawan" class="form-control">
            <?php


                $karyawanqry="SELECT iduser,nama,jabatan    FROM data_karyawan 
                                                            WHERE   jabatan!='Tukang Harian' AND
                                                                    jabatan!='Kuli Harian' AND
                                                                    jabatan!='Driver Harian'
                                                                    ".$default_access_list."
                                                                    ".$block_access_list."
                                                            ORDER BY nama ASC";
                $karyawan=getData($karyawanqry,"","all");
                $karyawan=$karyawan["data"];

                foreach($karyawan AS $value)
                {
                    echo '<option value="'.$value["iduser"].'">'.$value["nama"].' - '.$value["jabatan"].'</option>';
                }
            
            ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col u-pt-small">
            <button class="c-btn c-btn--info u-width-100" id="accessRights_addBlockAccess">Set Access : Block</button>
        </div>
    </div>


    

    <?php if(is_array($block_access) && count($block_access)>0){ ?>
    <div class="row u-mt-small">
        <div class="col u-pt-small">
            <?php
           
                foreach($block_access as $value)
                {
                    if(!isset($i)) $i=1; else $i++;
                    ?>
                    <div class="row row-hover u-ph-small u-text-small">
                        <div class="col-1 col-hover">
                            <?php echo $i; ?>
                        </div>
                        <div class="col-10 u-ph-zero col-hover" idjabatan="<?php echo $i; ?>">
                            <?php
                            $karyawan = getData("data_karyawan","iduser='".escStringDB($value)."'");
                            echo $karyawan["nama"]." - ".$karyawan["jabatan"];
                            ?>
                        </div>
                        <div class="col-1 col-hover">
                            <a id="accessRights_delBlockAccess<?php echo $value; ?>" class="access-rights-del-block-access" idkaryawan="<?php echo $value; ?>"><i class="fas fa-minus-circle"></i></a>
                        </div>
                    </div>
                    <?php
                }
            
            ?>
        </div>
    </div>
    <?php } //echo $karyawanqry; ?>



</div>