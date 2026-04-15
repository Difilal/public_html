<?php

$idangkatan=$_GET["idangkatan"];
//$angkatan=getData("data_angkatan","idangkatan='".$idangkatan."'");
//$sekolah =getData("data_sekolah","idsekolah='".$angkatan["idsekolah"]."'");

//NotifOrtuSiswaTidakAbsen($idangkatan);  // kirim notif ke ortu siswa yang tidak absen
//recheckAbsensiKalender($idangkatan);    // melengkapi data kalender
//WaSenderBalancer($idangkatan);          // meratakan beban antrian kirim
RekapAbsenWaliKelas($idangkatan);       // rekap data ke wali kelas
RekapDataAdmin($idangkatan);            // rekap data ke admin
//WaSenderSelfNetCom($idangkatan);        // saling kirim pesan antar wa sender

// lengkapi data absensi siswa
/*$jamAbsen=getJamAbsen($idangkatan);
if(strtotime(date("H:i")) > strtotime($jamAbsen["batas_jam_pulang"]))       $type="pulang";
elseif(strtotime(date("H:i")) > strtotime($jamAbsen["batas_jam_masuk"]))    $type="masuk";
else                                                                        $type="";
if($type=="pulang") setDataAbsensi($idangkatan,DateBySecond(60*60*24,"-"));*/




// rapihkan data /////////////////////////////////////////////////////////////////////////////////////////////////////////////
$datacek_qry1 ="UPDATE data_konsumen SET nohp1_status='nonaktif'  WHERE nohp1_status='aktif'  AND nohp1=''";
$datacek_qry2 ="UPDATE data_konsumen SET nohp2_status='nonaktif' WHERE nohp2_status='aktif' AND nohp2=''";
$datacek_qry3 ="UPDATE data_konsumen SET status_layanan='nonaktif' ";
$datacek_qry3.="WHERE status_layanan='aktif' AND ";
$datacek_qry3.="((nohp1='' AND nohp2='') OR (nohp1_status='nonaktif' AND nohp2_status='nonaktif'))";
runQuery($datacek_qry1);
runQuery($datacek_qry2);
runQuery($datacek_qry3);


echo date("Y-m-d H:i:s");