<?php

$idangkatan=$_GET["idangkatan"];

// lengkapi data absensi siswa
$jamAbsen=getJamAbsen($idangkatan);
if(strtotime(date("H:i")) > strtotime($jamAbsen["batas_jam_pulang"]))       $type="pulang";
elseif(strtotime(date("H:i")) > strtotime($jamAbsen["batas_jam_masuk"]))    $type="masuk";
else                                                                        $type="";
if($type=="pulang") setDataAbsensi($idangkatan,DateBySecond(60*60*24,"-"));

echo date("Y-m-d H:i:s");