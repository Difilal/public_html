<?php

if(isset($idartikel)){
    $ip = $_SERVER['REMOTE_ADDR'];
    $tanggal = date("Y-m-d H:i:s");

    $date = date("Y-m-d");

    $s = mysqli_query($conn, "SELECT * FROM web_artikel_visitor WHERE idartikel = $idartikel AND ip='$ip' AND DATE(timestamp) = '$date'");
	
	if($s->num_rows == 0){
		mysqli_query($conn, "INSERT INTO web_artikel_visitor(idartikel, ip, timestamp) VALUES('$idartikel','$ip','$tanggal')");
	}
}

$path = $_SERVER['REQUEST_URI'];

$parts = explode('/', trim($path, '/'));

$last = end($parts);

$pos  = strrpos($last, '-');
$slug = substr($last, 0, $pos);
$id   = substr($last, $pos + 1);

$artikel_id   = intval($id);
$artikel_slug = $slug;

$artikel_judul = ucwords(str_replace('-', ' ', $slug));