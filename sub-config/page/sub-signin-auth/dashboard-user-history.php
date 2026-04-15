<?php 

	if(isset($_SESSION["sess"]["HistoryActivity"]["Date"]) && $_SESSION["sess"]["HistoryActivity"]["Date"]!=""){
		$HistoryDate=$_SESSION["sess"]["HistoryActivity"]["Date"];
		//$DurasiAkses=GetData("SELECT SUM(TimeTotal) AS DurasiAkses FROM sys_user_history WHERE SUBSTR(TimeStart,1,10)='".$HistoryDate."'","x","DurasiAkses");
	}else{
        $HistoryDate=$_SESSION["sess"]["HistoryActivity"]["Date"]=substr(getdata("sys_user_history","iduser>0 ORDER BY TimeStart DESC LIMIT 1","TimeStart"),0,10);
        //$HistoryDate=$DurasiAkses="";
    } 
    $qry="SELECT SUM(TimeTotal) AS DurasiAkses FROM sys_user_history WHERE SUBSTR(TimeStart,1,10)='".$HistoryDate."'";
    $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
    $mfa=mysqli_fetch_array($mqr);
    $DurasiAkses=$mfa["DurasiAkses"];

    //echo $_SESSION["sess"]["HistoryActivity"]["Date"];

?>


<div class="d-block">
			<div class="row u-mb-large">
                <div class="col-sm-12">
					
                    <div class="c-table-responsive@desktop">	
                    <table class="c-table c-table--highlight" style="min-width: 600px;">



                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th colspan="6" class="c-table__cell c-table__cell--head u-p-small">
                                    
                                    
                                    <table width="100%" data-classes="table">
                                        <tbody class="c-table__head c-table__head--slim">
                                        <tr>
                                            <td width="40">
                                                <a class="c-btn c-btn--primary u-color-secondary" style="padding: 3px 10px;margin-right: 5px;line-height: 32px;height: 40px;"><i class="fas fa-user-tie"></i></a>
                                            </td>                                                
                                            <td>
                                                <div class="row u-pl-small">
                                                    <div class="col-9 u-pr-zero">
                                                        <div class="row">
                                                            <div class="col u-ph-zero">
                                                                <h3 class="u-m-zero"><a href="dashboard-user-history.html" class="u-m-zero u-color-primary">User History</a></h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col u-ph-zero"><?php
                                                                echo "Durasi Akses : ".SatuanWaktu($DurasiAkses);
                                                            ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 u-pr-small u-text-right">
                                                        <?php

                                                        //echo $HistoryDate;
                                                        $qry="SELECT DISTINCT SUBSTR(TimeStart,1,10) AS tgl from sys_user_history ORDER BY tgl DESC LIMIT 30";
                                                        $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                                                        while($tgl=mysqli_fetch_array($mqr))
                                                        {
                                                            if($HistoryDate==$tgl["tgl"]) $selected='selected style="background-color:lightblue;"'; else $selected="";
                                                            if(isset($option))$option.='<option value="'.$tgl["tgl"].'" '.$selected.'>'.FormatTgl($tgl["tgl"],"full-id").'</option>';
                                                            else $option='<option value="'.$tgl["tgl"].'" '.$selected.'>'.FormatTgl($tgl["tgl"],"full-id").'</option>';
                                                        }

                                                        ?>

                                                        <select id="HistoryDate" class="form-control" onChange="changeHistoryDate()">
                                                            <option value="">Pilih tanggal</option>
                                                            <?php echo $option; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    
                                    
                                    
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody class="i-table-hover">
                            <?php


                            $qry="SELECT * from sys_user_history WHERE SUBSTR(TimeStart,1,10)='".$HistoryDate."' ORDER BY timestamp DESC";
                            $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                            while($history=mysqli_fetch_array($mqr))
                            {   
                                $userData = marketing($history["userType"],$history["iduser"]);
                                ?>

                                <tr class="c-table__row">
                                    <td class="c-table__cell">
                                        <?php echo $history["domain"] ?>
                                    </td>
                                    <td class="c-table__cell">
                                        <?php echo $history["userType"] ?>
                                    </td>
                                    <td class="c-table__cell">
                                        <?php if(isset($userData["nama"])) echo $userData["nama"] ?>
                                    </td>
                                    <td class="c-table__cell">
                                        <?php echo FormatTgl($history["TimeStart"],"/") ?>
                                    </td>
                                    <td class="c-table__cell">
                                        <?php echo FormatWaktu($history["TimeStart"])." > ".FormatWaktu($history["TimeEnd"]) ?>
                                    </td>
                                    <td class="c-table__cell">
                                        <?php echo SatuanWaktu($history["TimeTotal"]) ?>
                                    </td>
                                </tr>
                                
                                <?php
                            }

                            ?>
                        </tbody>
                    </tbody>
                    </div>

                    </table>
                    </div>
					
                </div>
            </div>
	

</div><!-- // .container -->