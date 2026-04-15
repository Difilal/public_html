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


<div class="container">
			<div class="row u-mb-large" style="margin-top: 20px;">
                <div class="col-sm-12">
					
                    <div class="c-table-responsive@desktop">	
                    <table class="c-table">



                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th colspan="5" class="c-table__cell c-table__cell--head u-p-small">
                                    
                                    
                                    <table width="100%" data-classes="table">
                                        <thead class="c-table__head c-table__head--slim">
                                        <tr>
                                            <td width="40">
                                                <a class="c-btn c-btn--primary u-color-secondary" style="padding: 3px 10px;margin-right: 5px;line-height: 32px;height: 40px;"><i class="fas fa-user-tie"></i></a>
                                            </td>                                                
                                            <td>
                                                <div class="row u-pl-small">
                                                    <div class="col-9 u-pr-zero">
                                                        <div class="row">
                                                            <div class="col u-ph-zero">
                                                                <h3 style="" class="u-m-zero">User History</h3>
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
                                                <input type="hidden" value="<?php
                                                    $mqrKelas_DataSiswa=mysqli_query($_SESSION["sess"]["koneksi"],"SELECT DISTINCT kelas FROM data_konsumen ORDER BY kelas ASC");
                                                    while($Kelas_DataSiswa=mysqli_fetch_array($mqrKelas_DataSiswa)){
                                                      echo $Kelas_DataSiswa["kelas"].",";
                                                    }
                                                ?>">
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                    
                                    
                                    
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            function DataHistoryUser($iduser,$HistoryDate,$domain)
                            {	
                                if(substr($domain,0,5)=="admin" || substr($domain,0,7)=="sekolah")
                                {
                                    $datauser=DataUser($iduser);
                                    $nama=$datauser["nama"];
                                }
                                elseif(substr($domain,0,5)=="siswa")
                                {
                                    $datauser=DataSiswa($iduser);
                                    $nama=$datauser["nama"]." (".$datauser["kelas"].")";
                                }
                                elseif(substr($domain,0,4)=="ortu")
                                {
                                    $datauser=DataSiswa($iduser);
                                    $nama="Ortu ".$datauser["nama"]." (".$datauser["kelas"].")";
                                }
                                else
                                {
                                    $datauser=array("nama"=>"unknown");
                                    $nama="Unknown";
                                }
                                
                                $DurasiAkses=GetData("SELECT SUM(TimeTotal) AS DurasiAkses FROM sys_user_history WHERE iduser='".$iduser."' AND domain='".$domain."' AND SUBSTR(TimeStart,1,10)='".$HistoryDate."'","x","DurasiAkses");

                                $data='<table class="c-table u-inline-block u-mr-xsmall u-mb-xsmall"><thead class="c-table__head">';
                                $data.='<tr class="c-table__row"><th class="c-table__cell c-table__cell--head" colspan="2" height="20" style="font-size:12px;color:blue;">';
                                $data.=$nama;
                                $data.="<br>";
                                $data.=$domain;
                                $data.="<br>";
                                $data.="Durasi : ".SatuanWaktu($DurasiAkses);
                                $data.='</th></tr>';
                                $data.='</thead><tbody>';

                                $qry="SELECT * from sys_user_history WHERE iduser='".$iduser."' AND domain='".$domain."' AND SUBSTR(TimeStart,1,10)='".$HistoryDate."' ORDER BY TimeStart ASC";
                                $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                                while($history=mysqli_fetch_array($mqr)){
                                    $data.='<tr class="c-table__row">';
                                    $data.='<td class="c-table__cell" width="90" align="center">'.FormatWaktu($history["TimeStart"]).' - '.FormatWaktu($history["TimeEnd"]).'</td>';
                                    $data.='<td class="c-table__cell" align="right">'.SatuanWaktu($history["TimeTotal"]).'</td>';
                                    $data.='</tr>';
                                }
                                $data.='</tbody></table>';
                                return $data;
                            }


                            $qry="SELECT DISTINCT iduser,domain from sys_user_history WHERE SUBSTR(TimeStart,1,10)='".$HistoryDate."' ORDER BY timestamp DESC";
                            $mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
                            while($user=mysqli_fetch_array($mqr))
                            { ?>
                                <tr class="c-table__row">
                                    <td class="c-table__cell">
                                        
                                    </td>
                                </tr><?php
                                //echo DataHistoryUser($user["iduser"],$HistoryDate,$user["domain"]); 

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



<script>
	
	function changeHistoryDate()
	{
		HistoryDate=$("#HistoryDate").val();
		//if(HistoryDate!=""){
			$.post("ajax-dashboard-user-history.html", {HistoryDate:HistoryDate}, function(data,status){ 
				//alert(data);
				window.location.href = './dashboard-user-history.html'; 
			});
		//}
	}
	
</script>