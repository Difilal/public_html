<?php sleep(1);

	$nama		= trim($_POST["nama"]);
	$nohp1		= FormatNoHP($_POST["nohp1"]);
	$email1		= $_POST["email1"];
	$password	= $_POST["password"];
	$role		= $_POST["role"];
	$jabatan	= $_POST["jabatan"];

	$cekNoHp	= cekData("data_karyawan","nohp1='".$nohp1."' OR nohp2='".$nohp1."'");
	$cekEmail	= cekData("data_karyawan","email1='".$email1."' OR email2='".$email1."'");

	if($nama=="") $status["nama"]="Nama harus diisi";
	if(!isNoHp($nohp1)) $status["nohp1"]="Nohp tidak valid";
	elseif($cekNoHp>0) $status["nohp1"]="Nohp sudah terdaftar pada akun lain";
	if(!isValidEmail($email1)) $status["email1"]="Email tidak valid";
	elseif($cekEmail) $status["email1"]="Email sudah terdaftar pada akun lain";
	if(strlen($password)<6) $status["password"]="Password minimal 6 karakter";
	elseif(strlen($password)>32) $status["password"]="Password maksimal 32 karakter";
	if($jabatan=="") $status["jabatan"]="Jabatan wajib dipilih";
	
	if(!isset($status))
	{
		$qry	="	INSERT INTO data_karyawan ( nama,nohp1,nohp1_status,nohp2_status,email1,pswd,role,jabatan,tgl_input)
					VALUES					  (	'".escStringDB( $nama)."',
												'".escStringDB( $nohp1)."',
												'aktif',
												'nonaktif',
												'".escStringDB( $email1)."',
												'".md7($password)."',
												'".escStringDB( $role)."',
												'".escStringDB( $jabatan)."',
												'".date("Y-m-d H:i:s")."')";
		
		if(mysqli_query($_SESSION["sess"]["koneksi"],$qry)){
			$status["success"]="1";
		}
		else $status["respon"]="Input database error. ".$qry;//.mysqli_error($_SESSION["sess"]["koneksi"]);
	}

	echo json_encode($status);