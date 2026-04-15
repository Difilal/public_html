<?php 

//include ("dashboard-admin-data-sekolah-query.php");
//$sekolah=GetData("data_sekolah","idsekolah='1'");

?>

<input type="hidden" id="idsekolah" value="<?php echo $sekolah["idsekolah"]; ?>">
<div class="d-block">

			
			<?php
			$qry="SELECT * FROM data_email_sender";
			$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
			$JumlahNohpWa=mysqli_num_rows($mqr);
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
                                                            <a href="./dashboard-admin-data-email-sender.html" class="col u-ph-zero">
                                                                <h3 class="u-m-zero">Data Email Sender</h3>
                                                            </a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col u-ph-zero"><?php
                                                                echo "Jumlah : ".NumberFormat($JumlahNohpWa); 
                                                            ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 u-pr-small u-text-right">
                                                        <a class="c-btn c-btn--info u-color-secondary u-ml-auto" id="formTambahEmailSender">Tambah Email Sender</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                    
                                    
                                </th>
                            </tr>
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head">Nama Kontak</th>
                              <th class="c-table__cell c-table__cell--head">Username</th>
                              <th class="c-table__cell c-table__cell--head">SMTP Server</th>
                              <th class="c-table__cell c-table__cell--head">SMTP Port</th>
                              <th class="c-table__cell c-table__cell--head">Encryption</th>
                              <th class="c-table__cell c-table__cell--head">Require Auth</th>
                              <th class="c-table__cell c-table__cell--head">Worker Progress</th>
                              <th class="c-table__cell c-table__cell--head">Status</th>
                              <th class="c-table__cell c-table__cell--head">
                                  <span class="u-hidden-visually">Actions</span>
                              </th>
                            </tr>
                        </thead>

                        <tbody class="i-table-hover">
							
							<?php 
                            $dataSumQueue=$dataSumSent=$dataSumReceived=$dataSumSupQueue=$dataSumSupSent=$dataSumSupReceived=$DataWaSumDefaultSender=0;
                            while($mfa=mysqli_fetch_array($mqr)){ 
							//$angkatan=GetData("data_angkatan","idangkatan='".escStringDB($mfa["idangkatan"])."'");
							?>
                            <tr id="smtp<?php echo $mfa["idsmtp"]; ?>" class="c-table__row<?php if($mfa["status_layanan"]=="disconnected") echo " c-table__row--danger"; ?>">
                                <td class="c-table__cell" id="smtp_name_col<?php echo $mfa["idsmtp"]; ?>">
									<?php echo $mfa["smtp_name"]; ?>
                                </td>

                                <td class="c-table__cell" id="smtp_user_col<?php echo $mfa["idsmtp"]; ?>">
                                    <?php echo $mfa["smtp_user"]; ?>
                                </td>

                                <td class="c-table__cell" id="smtp_host_col<?php echo $mfa["idsmtp"]; ?>">
                                    <?php echo $mfa["smtp_host"]; ?>
                                </td>

                                <td class="c-table__cell" id="smtp_port_col<?php echo $mfa["idsmtp"]; ?>">
                                    <?php echo $mfa["smtp_port"]; ?>
                                </td>

                                <td class="c-table__cell" id="smtp_secure_col<?php echo $mfa["idsmtp"]; ?>">
                                    <?php echo $mfa["smtp_secure"]; ?>
                                </td>

                                <td class="c-table__cell" id="smtp_auth_col<?php echo $mfa["idsmtp"]; ?>">
                                    <?php echo $mfa["smtp_auth"]; ?>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataEmailSenderCronjob<?php echo $mfa["idsmtp"]; ?>"><?php 
                                        echo FormatDate($mfa["cronjob_last_operation"])." ".FormatWaktu($mfa["cronjob_last_operation"],"full");
                                        if($mfa["cronjob_operation"]>0){
                                            echo ' <sup class="sup-prog-data">';
                                            echo NumberFormat($mfa["cronjob_operation"]); 
                                            echo "</sup>";  
                                        }
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="StatusEmailSender<?php echo $mfa["idsmtp"]; ?>">
									<?php if($mfa["smtp_status"]=="connected"){ ?>
                                    <i class="fa fa-check u-color-success u-mr-xsmall"></i>Connected
									<?php }elseif($mfa["smtp_status"]=="disconnected"){ ?>
                                    <i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Disconnected
									<?php } ?>
                                    </span>
                                </td>

                                <td class="c-table__cell u-text-right">
									<div class="btn-group">
									  <a id="actbtn_smtp<?php echo $mfa["idsmtp"]; ?>" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i></a>
									  <div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item form-edit-smtp" idsmtp="<?php echo $mfa["idsmtp"]; ?>"><i class="fas fa-edit" style="color: darkblue;"></i> Edit Email Sender</a>
										<a class="dropdown-item status-smtp-toggle" idsmtp="<?php echo $mfa["idsmtp"]; ?>" id="linktogglestatussmtp<?php echo $mfa["idsmtp"]; ?>" statuslayanan="<?php echo $mfa["smtp_status"]; ?>"><?php 
											   if($mfa["smtp_status"]=="connected"){ echo '<i class="fas fa-unlink"></i> Disconnect Email Sender'; }
											   elseif($mfa["smtp_status"]=="disconnected"){ echo '<i class="fas fa-link"></i> Connect Email Sender'; } ?>
                                        </a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item modal-confirm" confirmtext="Hapus akun email sender <strong><?php echo $mfa["smtp_user"]; ?></strong> ?" confirmyes="HapusEmailSender(<?php echo $mfa["idsmtp"]; ?>)"><i class="fas fa-trash-alt" style="color: darkred;"></i> Hapus Email Sender</a>
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