<?php


$access_rights=getData("sys_hak_akses_utama","idaccess='".escStringDB($_POST["accessRights_idaccess"])."'");
$default_access=json_decode($access_rights["default_access"],true);


?>
<div class="d-block list-jabatan">

    <div class="row u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">
            Pathdir <span style="float:right;">:</span>
        </div>
        <div class="col-9 u-bg-secondary u-pl-zero">
        <?php echo $access_rights["pathdir"]; ?>
        </div>
    </div>
    <div class="row u-text-small u-text-mute">
        <div class="col-3 u-bg-secondary">
            Filename <span style="float:right;">:</span>
        </div>
        <div class="col-9 u-bg-secondary u-pl-zero">
        <?php echo $access_rights["filename"]; ?>
        </div>
    </div>

    <div class="row">
        <div class="col u-bg-secondary u-pv-small">
            <a class="check-all-jabatan u-color-facebook">Check All</a> | 
            <a class="uncheck-all-jabatan u-color-facebook">Uncheck All</a> | 
            <a class="invert-check-jabatan u-color-facebook">Invert</a>
        </div>
    </div>

    <input type="hidden" id="accessRights_idaccess" value="<?php if(isset($_POST["accessRights_idaccess"])) echo $_POST["accessRights_idaccess"]; ?>">


    <div class="d-block u-ph-small" style="max-height: 300px;overflow: scroll;overflow-x: hidden;">
    <?php
    foreach($_SESSION["sess"]["listJabatan"] as $value)
    { 
        if($value=="-----")
        {
            ?>
            <div class="row">
                <div class="col u-bg-secondary u-pv-zero">&nbsp;</div>
            </div>
            <?php
        }
        else
        {
            if(!isset($i)) $i=1; else $i++;
            if(is_array($default_access) && in_array($value,$default_access)) $checked="checked"; else $checked="";

            ?>
            <div class="row u-text-small" idjabatan="<?php echo $i; ?>">
                <div class="col-1 u-pr-zero">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $value; ?>" nama="jabatan[]" id="jabatan<?php echo $i; ?>" <?php echo $checked; ?>>
                    </div>
                </div>
                <div class="col-11 u-pl-zero label-jabatan" idjabatan="<?php echo $i; ?>">
                    <?php echo $value; ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
    </div>



    <div class="row">
        <div class="col u-pt-small">
            <button class="c-btn c-btn--info u-width-100" id="accessRights_SetDefaultAccess">Set Access</button>
        </div>
    </div>

</div>