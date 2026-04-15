<?php

	$username	= trim(strtolower($_POST["email"]));
	$username	= isNoHP(FormatNoHP($username))?FormatNoHP($username):$username;
	$username	= escStringDB($username);

	$password	= $_POST["password"];
	$password	= md7(escStringDB($password));

	$qry="SELECT * FROM data_karyawan WHERE ( email1='".$username."' OR email2='".$username."' OR nohp1='".$username."' OR nohp2='".$username."') AND pswd='".$password."'";
	$user=getdata($qry);

	if(cekdata($qry)==0){ $status="Username atau password salah"; }
	elseif($user["role"]!="admin"){ $status="Otoritas ditolak"; }
	//else if(cekAkun($email)==0) $status="Akun anda belum aktif, cek email dan klik link verifikasi.<br>".'Atau <a href="kirim-ulang-aktivasi.html">klik disini</a> untuk kirim ulang link aktivasi.';
	else{
		
		$_SESSION["sess"]["user"]     		= $user;
		$_SESSION["sess"]["iduser"]   		= $user["iduser"];
        $_SESSION["sess"]["role"]     		= $user["role"];
        $_SESSION["sess"]["jabatan"]  		= $user["jabatan"];
        $_SESSION["sess"]["base_profile"]   = "Karyawan";
        $status=1;
	}

	if(isset($status)){
		echo $status;
		//if($status!=1) loginlog($email,$status,$password); 
	}