<?php 

//include ("dashboard-admin-data-sekolah-query.php");
//$sekolah=GetData("data_sekolah","idsekolah='1'");

?>

<input type="hidden" id="idsekolah" value="<?php //echo $sekolah["idsekolah"]; ?>">
<div class="d-block">

			
			<?php
			$qry="SELECT * FROM data_nohp_wa";
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
                                                <a href="" class="c-btn u-color-secondary u-bg-success" style="padding: 3px 10px;margin-right: 5px;line-height: 32px;height: 40px;"><i class="fab fa-whatsapp"></i></a>
                                            </td>                                                
                                            <td>
                                                <div class="row u-pl-small">
                                                    <div class="col-9 u-pr-zero">
                                                        <div class="row">
                                                            <div class="col u-ph-zero">
                                                            <a href="./dashboard-admin-data-whatsapp-sender.html"><h3 class="u-m-zero">Data Nohp Whatsapp</h3></a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col u-ph-zero"><?php
                                                                echo "Jumlah : ".NumberFormat($JumlahNohpWa); 
                                                            ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 u-pr-small u-text-right">
                                                        <a class="c-btn c-btn--blue u-ml-auto" href="./dashboard-admin-tambah-nohp-whatsapp.html">Tambah Nohp Whatsapp</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                    
                                    
                                </th>
                            </tr>
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head">Nohp Whatsapp</th>
                              <th class="c-table__cell c-table__cell--head">Default Sender</th>
                              <th class="c-table__cell c-table__cell--head">Data Queue</th>
                              <th class="c-table__cell c-table__cell--head">Data Sent</th>
                              <th class="c-table__cell c-table__cell--head">Data Received</th>
                              <th class="c-table__cell c-table__cell--head">Worker Progress</th>
                              <th class="c-table__cell c-table__cell--head">Status Layanan</th>
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
                            <tr id="idwa<?php echo $mfa["idwa"]; ?>" class="c-table__row<?php if($mfa["status_layanan"]=="nonaktif") echo " c-table__row--danger"; ?>">
                                <td class="c-table__cell">
                                    <span class="copy-btn copy-btn-hover" data-clipboard-text="<?php echo $mfa["nohp_wa"]; ?>" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Copy To Clipboard">
									<?php echo $mfa["nohp_wa"]; ?>
                                    </span>
                                    <small class="d-block u-text-mute"><?php //echo $mfa["kota"].", ".$mfa["provinsi"]; ?></small>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DefaultSender<?php echo $mfa["idwa"]; ?>"><?php 
                                
                                    #$cekTabelLogin=cekData("data_login","last_wa_sender='".$mfa["nohp_wa"]."'");
                                    $cekTabelLogin=0;
                                    $cekTabelSiswa=cekData("data_konsumen","last_wa_sender='".$mfa["nohp_wa"]."'");
                                    //$cekTabelWlKls=cekData("data_wali_kelas","last_wa_sender='".$mfa["nohp_wa"]."'");
                                    echo $DefaulSender=$cekTabelLogin+$cekTabelSiswa;//+$cekTabelWlKls;
                                    $DataWaSumDefaultSender+=$DefaulSender;
                                
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaQueue<?php echo $mfa["idwa"]; ?>"><?php 
                                    // $dataQueue=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='queue'");
                                    $dataQueue=0;
                                    $dataSumQueue+=$dataQueue;
                                    echo NumberFormat($dataQueue); 
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaSent<?php echo $mfa["idwa"]; ?>"><?php 
                                    // $dataSent=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='sent'");
                                    $dataSent=0;
                                    $dataSumSent+=$dataSent;
                                    
                                    // $dataSupSent=cekData("data_log_wa","nohp_pengirim='".$mfa["nohp_wa"]."' AND status_kirim='sent' AND waktu LIKE '".date("Y-m-d")."%'");
                                    $dataSupSent=0;
                                    $dataSumSupSent+=$dataSupSent;
                                
                                    echo NumberFormat($dataSent);
                                    if($dataSupSent>0){
                                        echo ' <sup class="sup-prog-data">+';
                                        echo numberFormat($dataSupSent);
                                        echo "</sup>";   
                                    }
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaReceived<?php echo $mfa["idwa"]; ?>"><?php 
                                    // $dataReceived=cekData("data_log_wa","nohp_tujuan='".$mfa["nohp_wa"]."' AND status_kirim='received'");
                                    $dataReceived=0;
                                    $dataSumReceived+=$dataReceived;
                                    
                                    $dataSupReceived=cekData("data_log_wa","nohp_tujuan='".$mfa["nohp_wa"]."' AND status_kirim='received' AND waktu LIKE '".date("Y-m-d")."%'");
                                    $dataSumSupReceived+=$dataSupReceived;
                                
                                    echo NumberFormat($dataReceived); 
                                    if($dataSupReceived>0){
                                        echo ' <sup class="sup-prog-data">+';
                                        echo numberFormat($dataSupReceived);
                                        echo "</sup>";   
                                    }
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="DataWaCronjob<?php echo $mfa["idwa"]; ?>"><?php 
                                        echo FormatDate($mfa["cronjob_last_operation"])." ".FormatWaktu($mfa["cronjob_last_operation"],"full");
                                        if($mfa["cronjob_operation"]>0){
                                            echo ' <sup class="sup-prog-data">';
                                            echo NumberFormat($mfa["cronjob_operation"]); 
                                            echo "</sup>";  
                                        }
                                    ?></span>
                                </td>

                                <td class="c-table__cell">
                                    <span class="u-p-xsmall" style="border-radius: 10px;" id="StatusLayananWa<?php echo $mfa["idwa"]; ?>">
									<?php if($mfa["status_layanan"]=="aktif"){ ?>
                                    <i class="fa fa-check u-color-success u-mr-xsmall"></i>Aktif
									<?php }elseif($mfa["status_layanan"]=="nonaktif"){ ?>
                                    <i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Nonaktif
									<?php } ?>
                                    </span>
                                </td>

                                <td class="c-table__cell u-text-right">
									<div class="btn-group">
									  <a id="actbtn_nohpwa<?php echo $mfa["idwa"]; ?>" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i></a>
									  <div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="dashboard-admin-edit-nohp-whatsapp-<?php echo $mfa["idwa"]; ?>.html"><i class="fas fa-edit" style="color: darkblue;"></i> Edit Nohp Whatsapp</a>
										<a class="dropdown-item copy-btn" data-clipboard-text="<?php echo siteURL()."link-whatsapp-browser-".$mfa["idwa"].".html"; ?>"><i class="far fa-copy" style="color: darkgreen;"></i> Copy Link Whatsapp Browser</a>
										<a class="dropdown-item copy-btn" data-clipboard-text="<?php echo siteURL()."link-whatsapp-cronjob-per-menit-".$mfa["idwa"].".html"; ?>"><i class="far fa-copy" style="color: darkgreen;"></i> Copy Link Whatsapp Cronjob</a>
										<a class="dropdown-item status-wa-toggle" idwa="<?php echo $mfa["idwa"]; ?>" id="linktogglestatuswa<?php echo $mfa["idwa"]; ?>" statuslayanan="<?php echo $mfa["status_layanan"]; ?>"><?php 
											   if($mfa["status_layanan"]=="aktif"){ echo '<i class="fas fa-bell-slash"></i> Nonaktifkan Layanan'; }
											   elseif($mfa["status_layanan"]=="nonaktif"){ echo '<i class="fas fa-bell"></i> Aktifkan Layanan'; } ?>
                                        </a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item modal-confirm" confirmtext="Hapus nohp whatsapp <strong><?php echo $mfa["nohp_wa"]; ?></strong> ?" confirmyes="HapusNohpWhatsapp(<?php echo $mfa["idwa"]; ?>)"><i class="fas fa-trash-alt" style="color: darkred;"></i> Hapus Nohp Whatsapp</a>
									  </div>
									</div>
                                </td>
                            </tr>
							<?php } ?>
                            
                        </tbody>

                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell">Jumlah Data</th>
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
                                <th class="c-table__cell c-table__cell--head">&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head">&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head">
                                  <span class="u-hidden-visually">Actions</span>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    </div>
					
                </div>
            </div>
            
	
<?php //echo $_SESSION["sess"]["subpg"]; ?>
</div><!-- // .container -->