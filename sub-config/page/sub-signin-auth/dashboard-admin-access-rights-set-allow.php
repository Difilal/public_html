<?php


$access_rights=getData("sys_hak_akses_utama","idaccess='".escStringDB($_POST["accessRights_idaccess"])."'");

$default_access=$access_rights["default_access"];
if($default_access!="")         $default_access=json_decode($default_access,true); else $default_access="";
if(is_array($default_access))   $default_access_list="AND jabatan NOT IN ('".join("','",$default_access)."')";
else                            $default_access_list="";

$allow_access=getData("sys_hak_akses_utama","idaccess='".escStringDB($_POST["accessRights_idaccess"])."'","allow_access");
if($allow_access!="") $allow_access=json_decode($allow_access,true); else $allow_access="";
if(is_array($allow_access)) $allow_access_list=" AND iduser NOT IN ('".join("','",$allow_access)."')";
else                        $allow_access_list="";


?><div class="d-block">

<input type="hidden" id="accessRights_idaccess" value="<?php if(isset($_POST["accessRights_idaccess"])) echo $_POST["accessRights_idaccess"]; ?>">



    <div class="row u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">
            Pathdir <span style="float:right;">:</span>
        </div>
        <div class="col-9 u-pl-zero u-bg-secondary">
            <?php echo $access_rights["pathdir"]; ?>
        </div>
    </div>

    <div class="row u-mb-small u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">
            Filename <span style="float:right;">:</span>
        </div>
        <div class="col-9 u-pl-zero u-bg-secondary">
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
                                                                    ".$allow_access_list."
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
            <button class="c-btn c-btn--info u-width-100" id="accessRights_addAllowedAccess">Set Access : Allowed</button>
        </div>
    </div>


    

    <?php if(is_array($allow_access) && count($allow_access)>0){ ?>
    <div class="row u-mt-small">
        <div class="col u-pt-small">
            <?php
           
                foreach($allow_access as $value)
                {
                    if(!isset($i)) $i=1; else $i++;
                    ?>
                    <div class="row row-hover u-text-small u-ph-small">
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
                            <a id="accessRights_delAllowedAccess<?php echo $value; ?>" class="access-rights-del-allowed-access" idkaryawan="<?php echo $value; ?>"><i class="fas fa-minus-circle"></i></a>
                        </div>
                    </div>
                    <?php
                }
            
            ?>
        </div>
    </div>
    <?php } //echo $karyawanqry; ?>



</div>