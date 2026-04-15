<?php

$idangkatan=$_GET["idangkatan"];
$angkatan=getData("data_angkatan","idangkatan='".$idangkatan."'");
$sekolah =getData("data_sekolah","idsekolah='".$angkatan["idsekolah"]."'");

NotifOrtuSiswaTidakAbsen($idangkatan);  // kirim notif ke ortu siswa yang tidak absen 

echo date("Y-m-d H:i:s");