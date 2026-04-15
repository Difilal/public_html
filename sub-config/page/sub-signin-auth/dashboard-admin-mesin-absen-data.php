<?php 

//include ("dashboard-admin-data-sekolah-query.php");
//$sekolah=GetData("data_sekolah","idsekolah='1'");

?>
<div class="d-block">

			
			<?php
			$qry="SELECT * FROM data_absensi_mesin";
			$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
			$mesinAbsen=mysqli_num_rows($mqr);
			?>
			<div class="row u-mb-large">
                <div class="col-sm-12">
					
                    <div class="c-table-responsive@desktop">	
                    <table class="c-table c-table--highlight">



                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th colspan="9" class="c-table__cell c-table__cell--head u-p-small">                                 
                                    
                                    
                                    <table width="100%" data-classes="table">
                                        <thead class="c-table__head c-table__head--slim">
                                        <tr>
                                            <td width="50">
                                                <a href="" class="c-btn u-color-secondary u-bg-info" style="padding: 3px 10px;margin-right: 5px;line-height: 32px;height: 40px;"><i class="far fa-envelope"></i></a>
                                            </td>                                                
                                            <td>
                                                <div class="row u-pl-small">
                                                    <div class="col-9 u-pr-zero">
                                                        <div class="row">
                                                            <a href="./dashboard-admin-mesin-absen-data.html" class="col u-ph-zero">
                                                                <h3 class="u-m-zero">Data Mesin Absen</h3>
                                                            </a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col u-ph-zero"><?php
                                                                echo "Jumlah : ".NumberFormat($mesinAbsen); 
                                                            ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 u-pr-small u-text-right">
                                                        <a class="c-btn c-btn--info u-color-secondary u-ml-auto form-tambah-mesin-absen">Tambah Mesin Absen</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                    
                                    
                                </th>
                            </tr>
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head">Serial Number</th>
                              <th class="c-table__cell c-table__cell--head">Perusahaan</th>
                              <th class="c-table__cell c-table__cell--head">Cabang</th>
                              <th class="c-table__cell c-table__cell--head">Tgl. Register</th>
                              <th class="c-table__cell c-table__cell--head">Last Connected</th>
                              <th class="c-table__cell c-table__cell--head">Status Layanan</th>
                              <th class="c-table__cell c-table__cell--head">
                                  <span class="u-hidden-visually">Actions</span>
                              </th>
                            </tr>
                        </thead>

                        <tbody class="table-hover">
							
							<?php 
                            $dataSumQueue=$dataSumSent=$dataSumReceived=$dataSumSupQueue=$dataSumSupSent=$dataSumSupReceived=$DataWaSumDefaultSender=0;
                            while($mfa=mysqli_fetch_array($mqr)){ 
							//$angkatan=GetData("data_angkatan","idangkatan='".escStringDB($mfa["idangkatan"])."'");
							?>
                            <tr id="row_mesin_absen<?php echo $mfa["idmesin"]; ?>" class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                <td class="c-table__cell" id="serial_number<?php echo $mfa["idmesin"]; ?>">
									<?php echo $mfa["serial_number"]; ?>
                                </td>

                                <td class="c-table__cell" id="idperusahaan<?php echo $mfa["idmesin"]; ?>">
                                    <?php echo getData("data_perusahaan","idperusahaan='".$mfa["idperusahaan"]."'","nama_perusahaan"); ?>
                                </td>

                                <td class="c-table__cell" id="idcabang<?php echo $mfa["idmesin"]; ?>">
                                <?php echo getData("data_cabang","idcabang='".$mfa["idcabang"]."'","nama_cabang"); ?>
                                </td>

                                <td class="c-table__cell" id="tgl_register<?php echo $mfa["idmesin"]; ?>">
                                    <?php echo FormatTglWaktu($mfa["tgl_register"],array("tgl"=>"/","wkt"=>"full")); ?>
                                </td>

                                <td class="c-table__cell" id="cronjob_last_operation<?php echo $mfa["idmesin"]; ?>">
                                    <?php echo FormatTglWaktu($mfa["cronjob_last_operation"],array("tgl"=>"/","wkt"=>"full")); ?>
                                </td>

                                <td class="c-table__cell" id="status_layanan<?php echo $mfa["idmesin"]; ?>">
                                    <?php echo $mfa["status_layanan"]; ?>
                                </td>

                                <td class="c-table__cell u-text-right">
									<div class="btn-group">
									  <a id="actbtn_mesin_absen<?php echo $mfa["idmesin"]; ?>" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i></a>
									  <div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item form-edit-mesin-absen" idmesin="<?php echo $mfa["idmesin"]; ?>"><i class="fas fa-edit" style="color: darkblue;"></i> Edit Mesin Absen</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item hapus-mesin-absen" idmesin="<?php echo $mfa["idmesin"]; ?>"><i class="fas fa-trash-alt" style="color: darkred;"></i> Hapus Mesin Absen</a>
									  </div>
									</div>
                                </td>
                            </tr>
							<?php } ?>
                            
                        </tbody>

                        <!-- <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell" colspan="2">Jumlah Data</th>
                                <th class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumDefaultSender"><?php 
                                        echo NumberFormat($DataWaSumDefaultSender); 
                                    ?></span>
                                </th>
                                <th class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumQueue"><?php 
                                        echo NumberFormat($dataSumQueue); 
                                    ?></span>
                                </th>
                                <th class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumSent"><?php 
                                        echo NumberFormat($dataSumSent); 
                                        if($dataSumSupSent>0){
                                            echo ' <sup class="sup-prog-data">+';
                                            echo numberFormat($dataSumSupSent);
                                            echo "</sup>";   
                                        }
                                    ?></span>
                                </th>
                                <th class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSumReceived"><?php 
                                        echo NumberFormat($dataSumReceived); 
                                        if($dataSumSupReceived>0){
                                            echo ' <sup class="sup-prog-data">+';
                                            echo numberFormat($dataSumSupReceived);
                                            echo "</sup>";   
                                        }
                                    ?></span>
                                </th>
                                <th class="c-table__cell c-table__cell--head"></th>
                                <th class="c-table__cell c-table__cell--head"></th>
                                <th class="c-table__cell c-table__cell--head">
                                  <span class="u-hidden-visually">Actions</span>
                                </th>
                            </tr>
                        </thead> -->
                    </table>
                    </div>
					
                </div>
            </div>
            
	
<?php //echo $_SESSION["sess"]["subpg"]; ?>
</div><!-- // .container -->