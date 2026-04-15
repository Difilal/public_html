<?php 

//include ("dashboard-admin-data-sekolah-query.php");
//$sekolah=GetData("data_sekolah","idsekolah='1'");

?>

<input type="hidden" id="idsekolah" value="<?php echo $sekolah["idsekolah"]; ?>">
<div class="d-block">

			
			<?php
			$qry="SELECT * FROM data_karyawan ORDER BY  FIELD(role,'admin','manager','supervisor','operator'), nama ASC";
			$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
			$JumlahNohpWa=mysqli_num_rows($mqr);
			?>
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
                                                <a href="" class="c-btn u-color-secondary u-bg-facebook" style="padding: 3px 10px;margin-right: 5px;line-height: 32px;height: 40px;"><i class="fas fa-users-cog"></i></a>
                                            </td>                                                
                                            <td>
                                                <div class="row u-pl-small">
                                                    <div class="col-7 u-pr-zero">
                                                        <div class="row">
                                                            <a href="./dashboard-admin-data-operator.html" class="col u-ph-zero">
                                                                <h3 class="u-m-zero">Data Operator</h3>
                                                            </a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col u-ph-zero"><?php
                                                                echo "Jumlah : ".NumberFormat($JumlahNohpWa); 
                                                            ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5 u-pr-small u-text-right">
                                                        
                                                        
                                                        <div class="c-btn-group">
                                                            <a class="c-btn c-btn--blue u-ml-auto" href="./dashboard-admin-tambah-operator.html">Tambah Operator</a>
                                                            <a id="actbtn<?php //echo $mfa["idkonsumen"]; ?>" class="c-btn c-btn--primary  dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px 5px 5px 0px;padding: 8px;color:white;"><!--<i class="fas fa-cog"></i>--></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" onClick="GenCsvNohpOperator(<?php echo $_GET["idsekolah"]; ?>)">
                                                                        <i class="fas fa-file-csv" style="color: green;"></i>
                                                                        File CSV > Google Contact
                                                                    </a>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                    
                                    
                                    
                                </th>
                            </tr>
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head">Nama</th>
                              <th class="c-table__cell c-table__cell--head">NoHP</th>
                              <th class="c-table__cell c-table__cell--head">Email</th>
                              <th class="c-table__cell c-table__cell--head">Role</th>
                              <th class="c-table__cell c-table__cell--head">Jabatan</th>
                              <th class="c-table__cell c-table__cell--head">
                                  <span class="u-hidden-visually">Actions</span>
                              </th>
                            </tr>
                        </thead>

                        <tbody class="i-table-hover">
							
							<?php while($mfa=mysqli_fetch_array($mqr)){ 
							//$angkatan=GetData("data_angkatan","idangkatan='".escStringDB($mfa["idangkatan"])."'");
							?>
                            <tr id="iduser<?php echo $mfa["iduser"]; ?>" class="c-table__row">
                                <td class="c-table__cell">
                                    <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["nama"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
									<?php echo $mfa["nama"]; ?>
                                    </span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["nohp1"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
									<?php if($mfa["nohp1_status"]=="aktif") echo '<i class="fas fa-check-circle u-color-success"></i>'; else echo '<i class="fas fa-times-circle u-color-danger"></i>'; ?>
                                    <?php echo $mfa["nohp1"]; ?>
                                    </span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["email1"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
									<?php echo $mfa["email1"]; ?>
                                    </span>
                                </td>

                                <td class="c-table__cell">
                                    <?php   if($mfa["role"]=="admin") $classBgColor="u-bg-pinterest";
                                            elseif($mfa["role"]=="supervisor") $classBgColor="u-bg-success";
                                            elseif($mfa["role"]=="operator") $classBgColor="u-bg-facebook";
                                    ?>
									<span class="<?php echo $classBgColor; ?> u-color-secondary" style="padding:1px 10px;border-radius: 5px;"><?php 
                                    echo $mfa["role"]; 
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
									<?php echo $mfa["jabatan"]; ?>
                                </td>

                                <td class="c-table__cell u-text-right">
									<div class="btn-group">
									  <a id="actbtn_iduser<?php echo $mfa["iduser"]; ?>" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i></a>
									  <div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="dashboard-admin-edit-operator-<?php echo $mfa["iduser"]; ?>.html"><i class="fas fa-edit" style="color: darkblue;"></i> Edit Data Operator</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item modal-confirm" confirmtext="Hapus operator <strong><?php echo $mfa["nama"]; ?></strong> ?" confirmyes="HapusOperator(<?php echo $mfa["iduser"]; ?>)"><i class="fas fa-trash-alt" style="color: darkred;"></i> Hapus Data </a>
									  </div>
									</div>
                                </td>
                            </tr>
							<?php } ?>
                        </tbody>
                    </table>
                    </div>
					
                </div>
            </div>

	
<?php //echo $_SESSION["sess"]["subpg"]; ?>
</div><!-- // .container -->