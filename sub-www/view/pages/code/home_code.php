<?php 


	$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
	$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
	$waktu   = time(); //
	 
	// Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
	// echo "SELECT * FROM web_pengunjung_data WHERE ip='$ip' AND tanggal='$tanggal'";
	$s = mysqli_query($conn, "SELECT * FROM web_pengunjung_data WHERE ip='$ip' AND tanggal='$tanggal'");
	
	// Kalau belum ada, simpan data user tersebut ke database
	if($s->num_rows == 0){
		mysqli_query($conn, "INSERT INTO web_pengunjung_data(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
	}
	// Jika sudah ada, update
	else{
		mysqli_query($conn, "UPDATE web_pengunjung_data SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
	}
	$sql="SELECT sum(hits) as hits FROM web_pengunjung_data";
	$hits=mysqli_fetch_array(mysqli_query($conn, $sql));
	
	$pengunjung       = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM web_pengunjung_data WHERE tanggal='$tanggal' GROUP BY ip")); /* Hitung jumlah pengunjung */
	$totalpengunjung  = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(hits) hits FROM web_pengunjung_data")); /* hitung total pengunjung */
	$bataswaktu       = time() - 300;
	$pengunjungonline = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM web_pengunjung_data WHERE online > '$bataswaktu'")); /* hitung pengunjung online */

	$proyeksAll      = getData("SELECT * FROM web_proyek_data","","all")["data"];

	$query_artikel = "SELECT wa.*, wk.warna, wk.kategori FROM web_artikel AS wa LEFT JOIN web_kategori AS wk ON wa.idkategori = wk.idkategori WHERE wa.status_artikel = 1 AND wa.idkategori <> 1 ORDER BY tgl_input DESC LIMIT 4 OFFSET 0";
	
	$query_karir = "SELECT wa.*, wk.warna, wk.kategori FROM web_karir AS wa LEFT JOIN web_kategori_karir AS wk ON wa.idkategori = wk.idkategori WHERE wa.status_artikel = 1 ORDER BY tgl_input DESC LIMIT 4 OFFSET 0";
	// echo $query_artikel;

	$artikelHome 	= getData($query_artikel, "", "all")["data"];
	$karirHome 		= getData($query_karir, "", "all")["data"];

	// var_dump($artikelHome);

	$jmlArtikel = mysqli_num_rows(mysqli_query($conn, $query_artikel));
	$jmlKarir = mysqli_num_rows(mysqli_query($conn, $query_karir));