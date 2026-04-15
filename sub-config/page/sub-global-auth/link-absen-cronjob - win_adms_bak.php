<?php


mysqli_close($_SESSION["sess"]["koneksi"]);
include("link-mysql-hosting-server.php");
$idmesin	= $_GET["idmesin"];
$mesin		= getData("data_absensi_mesin","idmesin='".$idmesin."'");
$sekolah	= getData("data_sekolah","idsekolah='".$mesin["idsekolah"]."'");
$angkatan	= getData("data_angkatan","idangkatan='".$mesin["idangkatan"]."'");


mysqli_close($_SESSION["sess"]["koneksi"]);
include("link-mysql-absen-server.php");
$absen		= getData("checkinout","SN='".$mesin["serial_number"]."' ORDER BY checktime ASC LIMIT 1");
$cekAbsen	= cekData("checkinout","SN='".$mesin["serial_number"]."' ORDER BY checktime ASC LIMIT 1");
$userinfo	= getData("userinfo","userid='".$absen["userid"]."' LIMIT 1");
$idcheckinout		= $absen["id"];
$waktu_absen		= $absen["checktime"];
$idabsensi			= $userinfo["badgenumber"];
$sn_mesin_absensi	= $mesin["serial_number"];
if($idabsensi!="") $data["idabsensi"] = $idabsensi;
$data["tgl_absen"]	= FormatTgl($waktu_absen,"full-id");
$data["jam_absen"]	= Formatwaktu($waktu_absen,"full");




mysqli_close($_SESSION["sess"]["koneksi"]);
include("link-mysql-hosting-server.php"); 
if($cekAbsen>0 && !isset($browserjob)){
	
	$siswa	= getData("data_konsumen","idabsensi='".$idabsensi."' AND idsekolah='".$mesin["idsekolah"]."' AND idangkatan='".$mesin["idangkatan"]."'");
	$data["nama_siswa"]	= $siswa["nama"];
	$data["nisn"]=$siswa["nisn"];
	
	$message  = "*_.:: NOTIFIKASI ABSEN SISWA ::._*"."\n";
	$message .= "Sekolah : *".$sekolah["nama_sekolah"]."*\n";
	if($siswa["kelas"]!="") $message .= "Kelas : *".$siswa["kelas"]."*\n";
	$message .= "Nama : *".$siswa["nama"]."*\n";
	$message .= "Tgl. Absen : *".$data["tgl_absen"]."*\n";
	$message .= "Jam Absen : *".$data["jam_absen"]."*";
	
	
	if($sekolah["status_layanan"]=="aktif" && $angkatan["status_layanan"]=="aktif" && 
	   	$siswa["status_layanan"]=="aktif" && ($siswa["nohp1"]!="" || $siswa["nohp2"]!="")){
		$kirim_notif="queue"; $data["kirim_notifikasi"]="Ya";
		if($siswa["nohp1"]!="") $nohp1=$siswa["nohp1"]; else $nohp1=$siswa["nohp2"];
	}
	else{ $kirim_notif="no"; $data["kirim_notifikasi"]="Tidak"; $nohp1=""; }
	
	$JmlhNohpWa=cekData("data_nohp_wa","idsekolah='".$siswa["idsekolah"]."' AND idangkatan='".$siswa["idangkatan"]."'");
	$DataNohpWa=getData("data_nohp_wa","idsekolah='".$siswa["idsekolah"]."' AND idangkatan='".$siswa["idangkatan"]."'");
	if($JmlhNohpWa>1)
	{
		// kolek data jumlah pesan terkirim masing2 nohp wa sender
		$mqr=mysqli_query($_SESSION["sess"]["koneksi"],"SELECT * FROM data_nohp_wa WHERE idsekolah='".$siswa["idsekolah"]."' AND idangkatan='".$siswa["idangkatan"]."'");
		while($mfa=mysqli_fetch_array($mqr)){ 
			if(!isset($n)) $n=0; else ++$n;
			$nohp_wa[$n]=$mfa["nohp_wa"];
			$JmlhPesan[$n]=cekData("data_log_wa","SUBSTR(waktu,1,10)='".date("Y-m-d")."' AND nohp_pengirim='".$nohp_wa[$n]."' AND (status_kirim='sent' OR status_kirim='queue')");  //
		}
		// menentukan nohp wa sender bersarkan jumlah pesan yg sdh terkirim paling sedikit 
		for($n=0;$n<count($nohp_wa);$n++){ if($JmlhPesan[$n]==min($JmlhPesan)){ $NohpWaSender=$nohp_wa[$n]; break; }}
	}elseif($JmlhNohpWa==1){ $NohpWaSender=$DataNohpWa["nohp_wa"];
	}else{ $NohpWaSender=""; $kirim_notif="no"; $data["kirim_notifikasi"]="Tidak"; }
	

	if($kirim_notif=="queue") $kirim_notif2="yes"; else $kirim_notif2=$kirim_notif;
	$qry_insert1 ="INSERT INTO data_absensi (idkonsumen,idabsensi, idsekolah, idangkatan, nisn, waktu_absen, sn_mesin_absensi,kirim_notif) ";
	$qry_insert1.="VALUES ('".$siswa["idkonsumen"]."','".$idabsensi."','".$siswa["idsekolah"]."','".$siswa["idangkatan"]."','".$siswa["nisn"]."','".$waktu_absen."','".$sn_mesin_absensi."','".$kirim_notif2."')";
	if(runQuery($qry_insert1)){
		
		if($kirim_notif=="queue"){
			$last_idcheckinout_absensi=mysqli_insert_id($_SESSION["sess"]["koneksi"]);
			$qry_insert2 ="INSERT INTO data_log_wa (tipe_pesan,nohp_pengirim, nohp_tujuan, pesan, status_kirim, waktu) ";
			$qry_insert2.="VALUES ('outbox','".$NohpWaSender."','".$nohp1."','".$message."','".$kirim_notif."','".date("Y-m-d H:i:s")."')";
			if(runQuery($qry_insert2)){
				$last_idcheckinout_logwa=mysqli_insert_id($_SESSION["sess"]["koneksi"]);
				runQuery("UPDATE data_absensi SET idlogwa='".$last_idcheckinout_logwa."' WHERE idcheckinout='".$last_idcheckinout_absensi."'");
			}
		}
			
		mysqli_close($_SESSION["sess"]["koneksi"]);
		include("link-mysql-absen-server.php");
		$qry_delete="DELETE FROM checkinout WHERE id='".$idcheckinout."' LIMIT 1";
		runQuery($qry_delete);
	}
}

mysqli_close($_SESSION["sess"]["koneksi"]);
include("link-mysql-hosting-server.php"); 
$cronjob_last_operation=substr($mesin["cronjob_last_operation"],0,10);
if(date("Y-m-d")!=$cronjob_last_operation) $cronjob_operation="0";
else $cronjob_operation=$mesin["cronjob_operation"]+1;
runQuery("UPDATE data_absensi_mesin SET cronjob_operation='".$cronjob_operation."', cronjob_last_operation='".date("Y-m-d H:i:s")."' WHERE idmesin='".$idmesin."'");
//if(isset($_POST["idmesin"]) && $data["idabsensi"]!="") 
if(isset($_POST["idmesin"])) echo json_encode($data);