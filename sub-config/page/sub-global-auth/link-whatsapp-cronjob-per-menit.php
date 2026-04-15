<?php

$i=1;
$t1=$t2=date("Y-m-d H:i:s");
//echo strtotime($t2)-strtotime($t1);

while(strtotime($t2)-strtotime($t1)<30){
	
	echo $i.". execute at ".$t2;
	echo "<br>";
	include("link-whatsapp-cronjob.php");
    if($cekLogWA==0) break;
	sleep(3); ++$i;
	$t2=date("Y-m-d H:i:s");
}