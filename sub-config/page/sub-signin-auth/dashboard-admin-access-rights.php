<?php 

include ("dashboard-admin-access-rights-query.php");

//$qry="SELECT * FROM data_karyawan ORDER BY  FIELD(role,'admin','manager','supervisor','operator'), nama ASC";
//$qry="SELECT * FROM data_karyawan ORDER BY nama ASC";
$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry_total_data);

?>
<style>
tbody.i-table-hover tr td
{ 
    padding: 5px; 
    font-weight: normal;
}
tr.head-column th
{
    padding: 5px !important;
}
.default-access-color
{
    cursor: pointer;
    display: inline-block;
    padding: 0px 7px;
    border-radius: 5px;
    background-color: cyan;
    font-weight: bold;
    color: black;
}
.allow-access-color
{
    cursor: pointer;
    display: inline-block;
    padding: 0px 7px;
    border-radius: 5px;
    background-color: greenyellow;
    font-weight: bold;
    color: black;
}
.block-access-color
{
    cursor: pointer;
    display: inline-block;
    padding: 0px 7px;
    border-radius: 5px;
    background-color: red;
    font-weight: bold;
    color: black;
}
.list-jabatan .row .col-1, .list-jabatan .row .col-11
{
    border-bottom: 1px solid #F0F0F0;
}
.list-jabatan .row:hover .col-1, .list-jabatan .row:hover .col-11
{
    cursor: pointer;
    background-color: yellow;
}
.row-hover .col-hover
{
    border-bottom: 1px solid #F0F0F0;
}
.row-hover:hover .col-hover
{
    cursor: pointer;
    background-color: yellow;
}
.access-rights-del-allowed-access i
{
    color: #AAAAAA;
}
.access-rights-del-allowed-access:hover i
{
    color: red;
}
</style>
<div class="d-block">
    <?php //echo $qry_total_data; ?>
</div>
<div class="d-block">

			<div class="row u-mb-large">
                <div class="col-sm-12">
					
					
					<div class="c-table-responsive@desktop">	
                    <table class="c-table c-table--highlight">



                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th colspan="6" class="c-table__cell c-table__cell--head u-p-small">
                                    
                                    
                                    
                                    <table width="100%" data-classes="table">
                                        <thead class="c-table__head c-table__head--slim">
                                        <tr>
                                            <td width="40">
                                                <a href="" class="c-btn u-color-secondary u-bg-facebook" style="padding: 3px 10px;margin-right: 5px;line-height: 32px;height: 40px;"><i class="fas fa-user-tie"></i></a>
                                            </td>                                                
                                            <td>
                                                <div class="row u-pl-small">
                                                    <div class="col-7 u-pr-zero">
                                                        <div class="row">
                                                            <a href="./dashboard-admin-access-rights.html" class="col u-ph-zero">
                                                                <h3 class="u-m-zero">Access Rights</h3>
                                                            </a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col u-ph-zero"><?php
                                                                echo "Jumlah : ".NumberFormat($total_data); 
                                                            ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5 u-pr-small u-text-right">
                                                        
                                                        
                                                        <!-- <div class="c-btn-group">
                                                            <a class="c-btn c-btn--blue u-ml-auto" href="./dashboard-admin-access-rights.html">Tambah Karyawan</a>
                                                            <a id="actbtn<?php //echo $mfa["idkonsumen"]; ?>" class="c-btn c-btn--primary  dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px 5px 5px 0px;padding: 8px;color:white;"></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item gen-csv-nohp-karyawan">
                                                                        <i class="fas fa-file-csv" style="color: green;"></i>
                                                                        File CSV > Google Contact
                                                                    </a>
                                                                </div>
                                                        </div> -->


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                    
                                    
                                    
                                </th>
                            </tr>



                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head" colspan="11">
                                    
                                    
                                    
                                    
                                    <div class="u-inline-block" id="wrapperfilterModul_AccessRights">
                                        <select class="form-control form-control-sm" id="filterModul_AccessRights">
                                                <option value="">Semua Modul</option>
                                                <option value="isset"<?php if($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]=="isset") echo ' selected'; ?>>Isset Modul</option>
                                                <option value="unset"<?php if($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]=="unset") echo ' selected'; ?>>Unset Modul</option>
                                                <option value="nonmodul"<?php if($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]=="nonmodul") echo ' selected'; ?>>Non Modul</option>
                                                <option disabled>------------------------------------------</option>
                                                <?php 
                                                $qryfilterModul_AccessRights="SELECT DISTINCT nama_modul FROM sys_hak_akses_modul ORDER BY nama_modul ASC";
                                                $mqrfilterModul_AccessRights=mysqli_query($_SESSION["sess"]["koneksi"],$qryfilterModul_AccessRights);
                                                while($filterModul_AccessRights=mysqli_fetch_array($mqrfilterModul_AccessRights))
                                                {
                                                    if($filterModul_AccessRights["nama_modul"]==$_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]){ $selectOption="selected"; }else{ $selectOption="";}
                                                    ?><option value="<?php echo $filterModul_AccessRights["nama_modul"]; ?>" <?php echo $selectOption; ?>><?php echo $filterModul_AccessRights["nama_modul"]; ?></option><?php 
                                                    $selectOption="";
                                                }

                                                ?>
                                        </select>
                                    </div>

                                    
                                    <div class="u-inline-block ml-1" id="wrapperfilterFitur_AccessRights">
                                        <select class="form-control form-control-sm" id="filterFitur_AccessRights">
                                                <option value="">Semua Fitur</option>
                                                <?php 
                                                $qryfilterFitur_AccessRights="SELECT * FROM sys_hak_akses_modul GROUP BY sub_modul ORDER BY nama_modul ASC, sub_modul ASC";
                                                $mqrfilterFitur_AccessRights=mysqli_query($_SESSION["sess"]["koneksi"],$qryfilterFitur_AccessRights);
                                                $nama_modul="";
                                                while($filterFitur_AccessRights=mysqli_fetch_array($mqrfilterFitur_AccessRights))
                                                {
                                                    if($nama_modul!=$filterFitur_AccessRights["nama_modul"])
                                                    {
                                                        $nama_modul=$filterFitur_AccessRights["nama_modul"];
                                                        echo "<option disabled>------------------------------------------</option>";
                                                        echo '<option class="u-text-bold bg-light" disabled>'.$filterFitur_AccessRights["nama_modul"].'</option>';
                                                    }

                                                    if($filterFitur_AccessRights["sub_modul"]==$_SESSION["sess"]["AccessRights"]["filterFitur_AccessRights"]){ $selectOption="selected"; }else{ $selectOption="";}
                                                    ?><option value="<?php echo $filterFitur_AccessRights["sub_modul"]; ?>" <?php echo $selectOption; ?>><?php echo $filterFitur_AccessRights["sub_modul"]; ?></option><?php 
                                                    $selectOption="";
                                                }

                                                ?>
                                        </select>
                                    </div>

                                    
                                    <div class="u-inline-block ml-1" id="wrapperfilterPathdir_AccessRights">
                                        <select class="form-control form-control-sm" id="filterPathdir_AccessRights">
                                                <option value="">Semua Path Directory</option>
                                                <option value="" disabled>-----------------------------</option>
                                                <?php 
                                                $qryfilterPathdir_AccessRights="SELECT DISTINCT pathdir FROM sys_hak_akses_utama ORDER BY pathdir ASC";
                                                $mqrfilterPathdir_AccessRights=mysqli_query($_SESSION["sess"]["koneksi"],$qryfilterPathdir_AccessRights);
                                                while($filterPathdir_AccessRights=mysqli_fetch_array($mqrfilterPathdir_AccessRights)){
                                                    if($filterPathdir_AccessRights["pathdir"]==$_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"]){ $selectOption="selected"; }else{ $selectOption="";}
                                                    ?><option value="<?php echo $filterPathdir_AccessRights["pathdir"]; ?>" <?php echo $selectOption; ?>><?php echo $filterPathdir_AccessRights["pathdir"]; ?></option><?php 
                                                    $selectOption="";
                                                }

                                                ?>
                                        </select>
                                    </div>

                                    
                                    <div class="u-inline-block ml-1" style="width: 280px;" id="wrapperFilterKeyword">
                                        <input class="form-control form-control-sm" id="search_filename" type="text" placeholder="Filename" value="<?php echo $_SESSION["sess"]["AccessRights"]["search_filename"]; ?>">
                                    </div>
                                    
                                    
                                    <div class="u-inline ml-1" id="wrapperFilter_AccessRights">
                                        <button class="btn btn-primary btn-sm" id="Filter_AccessRights">Filter Data</button>
                                    </div>
                                    
                                    
                                </th>
                            </tr>



                            <tr class="c-table__row head-column">
                              <th class="c-table__cell c-table__cell--head">Modul</th>
                              <th class="c-table__cell c-table__cell--head">Pathdir</th>
                              <th class="c-table__cell c-table__cell--head">Filename</th>
                              <th class="c-table__cell c-table__cell--head" style="width: 70px;">Default</th>
                              <th class="c-table__cell c-table__cell--head" style="width: 70px;">Allow</th>
                              <th class="c-table__cell c-table__cell--head" style="width: 70px;">Block</th>
                            </tr>
                        </thead>

                        <tbody class="i-table-hover">
							
							<?php while($mfa=mysqli_fetch_array($mqr)){ 
                            //$angkatan=GetData("data_angkatan","idangkatan='".escStringDB($mfa["idangkatan"])."'");
                            
                            $fullpathfile=$mfa["pathdir"].$mfa["filename"].".php";
                            if(!file_exists($fullpathfile)) $textColor="u-color-danger u-text-bold"; 
                            elseif($mfa["hku_idmodul"]<0)   $textColor="u-color-success";
                            elseif($mfa["hku_idmodul"]==0)  $textColor="u-color-info";
                            else                            $textColor="";

							?>
                            <tr id="idaccess<?php echo $mfa["idaccess"]??rand(1234,8910); ?>" class="c-table__row cursor-pointer row-acces-rights" idaccess="<?php echo $mfa["idaccess"]; ?>">


                                <td class="c-table__cell <?php echo $textColor; ?>" id="labelModul<?php echo $mfa["idaccess"]??rand(1234,8910); ?>">
                                    <?php 
                                        echo $mfa["nama_modul"]!=""?$mfa["nama_modul"]." / ".$mfa["sub_modul"]:"";
                                        // echo " ::.. ".$mfa["hku_idmodul"]
                                    ?>
                                </td>

                                <td class="c-table__cell <?php echo $textColor; ?>">
                                    <?php 
                                        if($_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"]!="") echo highlight($_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"],$mfa["pathdir"]);
                                        else                                                                    echo $mfa["pathdir"];
                                    ?>
                                </td>

                                <td class="c-table__cell <?php echo $textColor; ?>">
                                    <?php 
                                        if($_SESSION["sess"]["AccessRights"]["search_filename"]!="")    echo highlight($_SESSION["sess"]["AccessRights"]["search_filename"],$mfa["filename"]);
                                        else                                                            echo $mfa["filename"];
                                    ?>
                                </td>

                                <td class="c-table__cell">
                                    <?php 
                                    
                                    if(isJson($mfa["default_access"])) $default=json_decode($mfa["default_access"],true); else $default=array();
                                    echo '<span id="default_access_'.$mfa["idaccess"].'" class="default-access-rights default-access-color" idaccess="'.$mfa["idaccess"].'" column="default_access">';
                                    if(count($default)>0) echo count($default); else echo "&nbsp;&nbsp;";
                                    echo '</span>';
                                    
                                    ?>
                                </td>

                                <td class="c-table__cell">
                                    <?php 
                                    
                                    if(isJson($mfa["allow_access"])) $allow=json_decode($mfa["allow_access"],true); else $allow=array();
                                    echo '<span id="allow_access_'.$mfa["idaccess"].'" class="allow-access-rights allow-access-color" idaccess="'.$mfa["idaccess"].'" column="allow_access">';
                                    if(count($allow)>0) echo count($allow); else echo "&nbsp;&nbsp;";
                                    echo '</span>';
                                    
                                    ?>
                                </td>

                                <td class="c-table__cell">
                                    <?php 
                                    
                                    if(isJson($mfa["block_access"])) $block=json_decode($mfa["block_access"],true); else $block=array();
                                    echo '<span id="block_access_'.$mfa["idaccess"].'" class="block-access-rights block-access-color" idaccess="'.$mfa["idaccess"].'" column="block_access">';
                                    if(count($block)>0) echo count($block); else echo "&nbsp;&nbsp;";
                                    echo '</span>';
                                    
                                    ?>
                                </td>

                            </tr>
							<?php } ?>
                        </tbody>
                    </table>
                    </div>

                    <?php include("sysfiles-".md5("sysfiles")."/"."page-number-bottom.php"); ?>
					
                </div>
            </div>

	
<?php //echo $_SESSION["sess"]["subpg"]; ?>
</div><!-- // .container -->