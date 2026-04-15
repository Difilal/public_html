<?php sleep(1);

	$iduser		= $_POST["iduser"];
	$nama		= trim($_POST["nama"]);
	$nohp1		= FormatNoHP($_POST["nohp1"]);
	$email1		= $_POST["email1"];
	$password	= $_POST["password"];
	$role		= $_POST["role"];
	$jabatan	= $_POST["jabatan"];

	$cekNoHp	= cekData("data_karyawan","(nohp1='".$nohp1."' OR nohp2='".$nohp1."') AND iduser!='".$iduser."'");
	$cekEmail	= cekData("data_karyawan","(email1='".$email1."' OR email2='".$email1."') AND iduser!='".$iduser."'");

	if($nama=="") $status["nama"]="Nama harus diisi";
	if(!isNoHp($nohp1)) $status["nohp1"]="Nohp tidak valid";
	elseif($cekNoHp>0) $status["nohp1"]="Nohp sudah terdaftar pada akun lain";
	if(!isValidEmail($email1)) $status["email"]="Email tidak valid";
	elseif($cekEmail) $status["email"]="Email sudah terdaftar pada akun lain";
	if($password!="" && strlen($password)<6) $status["password"]="Password minimal 6 karakter";
	elseif($password!="" && strlen($password)>32) $status["password"]="Password maksimal 32 karakter";
	
	if(!isset($status))
	{
		if($password!="") 	$updatePassword=", pswd='".md7($password)."'";
		else				$updatePassword="";

		$qry	="UPDATE data_karyawan 	SET
										nama	='".escStringDB( $nama)."',
										nohp1	='".escStringDB( $nohp1)."',
										email1	='".escStringDB( $email1)."',
										role	='".escStringDB( $role)."',
										jabatan	='".escStringDB( $jabatan)."'".
										$updatePassword."
										WHERE
										iduser	='".escStringDB( $iduser)."'";
		
		if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){
			$status["success"]="1";
		}
		else $status["respon"]="Response Failed";//.mysqli_error($_SESSION["sess"]["koneksi"]);
	}

	echo json_encode($status);