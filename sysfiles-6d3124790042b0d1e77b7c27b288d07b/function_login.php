<?php


if (!function_exists('setParamLogin'))
{
	function setParamLogin($userType="",$iduser=-1)
	{
		if($iduser>0)
		{
			if($userType=="Karyawan")
			{	
				$data									= GetData("SELECT * FROM data_karyawan WHERE iduser='".$iduser."'");
				$_SESSION["sess"]["user"]     			= $data; 
				$_SESSION["sess"]["iduser"]   			= $data["iduser"];
				$_SESSION["sess"]["idperusahaan"] 		= $data["idperusahaan"];
				$_SESSION["sess"]["idperusahaan_induk"] = $data["idperusahaan_induk"];
				$_SESSION["sess"]["role"]     			= $data["role"];
				$_SESSION["sess"]["base_role"]     		= $data["role"];
				$_SESSION["sess"]["jabatan"]  			= $data["jabatan"];
				$_SESSION["sess"]["base_jabatan"]  		= $data["jabatan"];
				$_SESSION["sess"]["base_profile"]  		= "Karyawan";
			}
			elseif($userType=="Marketing Agent")
			{	
				$data									= GetData("SELECT * FROM data_agent WHERE iduser='".$iduser."'");
				$_SESSION["sess"]["user"]     			= $data;
				$_SESSION["sess"]["iduser"]   			= $data["iduser"];
				$_SESSION["sess"]["role"]     			= "operator";
				$_SESSION["sess"]["base_role"]     		= "operator";
				$_SESSION["sess"]["jabatan"]  			= "Marketing Agent";
				$_SESSION["sess"]["base_jabatan"]  		= "Marketing Agent";
				$_SESSION["sess"]["base_profile"]  		= "Marketing Agent";
			}
			elseif($userType=="Konsumen")
			{	
				$data							= GetData("SELECT * FROM data_konsumen WHERE idkonsumen='".$iduser."'");
				$_SESSION["sess"]["user"]     			= $data;
				$_SESSION["sess"]["iduser"]   			= $data["idkonsumen"];
				$_SESSION["sess"]["role"]     			= "operator";
				$_SESSION["sess"]["base_role"]     		= "operator";
				$_SESSION["sess"]["jabatan"]  			= "Konsumen";
				$_SESSION["sess"]["base_jabatan"]  		= "Konsumen";
				$_SESSION["sess"]["base_profile"]  		= "Konsumen";
			}
		}
	}
}


if (!function_exists('cekParamLogin'))
{
	function cekParamLogin()
	{
		if($_SESSION["sess"]["iduser"]>0)
		{
			if($_SESSION["sess"]["base_profile"]=="Karyawan")
			{	
				$cek = 	cekData("	SELECT * FROM 	data_karyawan 
									WHERE 	 		iduser				= '".escStringDB($_SESSION["sess"]["iduser"])."' AND 
											 		idperusahaan_induk	= '".escStringDB($_SESSION["sess"]["user"]["idperusahaan_induk"])."' AND 
											 		idperusahaan		= '".escStringDB($_SESSION["sess"]["user"]["idperusahaan"])."' AND 
											 		idcabang			= '".escStringDB($_SESSION["sess"]["user"]["idcabang"])."' AND 
											 		pswd				= '".escStringDB($_SESSION["sess"]["user"]["pswd"])."' AND 
											 		nohp1				= '".escStringDB($_SESSION["sess"]["user"]["nohp1"])."' AND 
											 		nohp2				= '".escStringDB($_SESSION["sess"]["user"]["nohp2"])."' AND 
											 		email1				= '".escStringDB($_SESSION["sess"]["user"]["email1"])."' AND 
											 		email2				= '".escStringDB($_SESSION["sess"]["user"]["email2"])."' AND 
											 		jabatan				= '".escStringDB($_SESSION["sess"]["user"]["jabatan"])."' AND 
											 		direct_supervisor	= '".escStringDB($_SESSION["sess"]["user"]["direct_supervisor"])."' AND 
											 		status				= '".escStringDB($_SESSION["sess"]["user"]["status"])."'");
			}
			elseif($_SESSION["sess"]["base_profile"]=="Marketing Agent")
			{	
				$cek = 	cekData("	SELECT * FROM 	data_agent 
									WHERE 	 		iduser				= '".escStringDB($_SESSION["sess"]["iduser"])."' AND 
											 		idperusahaan		= '".escStringDB($_SESSION["sess"]["user"]["idperusahaan"])."' AND 
											 		idcabang			= '".escStringDB($_SESSION["sess"]["user"]["idcabang"])."' AND 
											 		pswd				= '".escStringDB($_SESSION["sess"]["user"]["pswd"])."' AND 
											 		nohp1				= '".escStringDB($_SESSION["sess"]["user"]["nohp1"])."' AND 
											 		nohp2				= '".escStringDB($_SESSION["sess"]["user"]["nohp2"])."' AND 
											 		email1				= '".escStringDB($_SESSION["sess"]["user"]["email1"])."' AND 
											 		email2				= '".escStringDB($_SESSION["sess"]["user"]["email2"])."' AND  
											 		direct_supervisor	= '".escStringDB($_SESSION["sess"]["user"]["direct_supervisor"])."' AND 
											 		status				= '".escStringDB($_SESSION["sess"]["user"]["status"])."'");
			}
			elseif($_SESSION["sess"]["base_profile"]=="Konsumen")
			{	
				$cek = 	cekData("	SELECT * FROM 	data_konsumen 
									WHERE 	 		idkonsumen			='".escStringDB($_SESSION["sess"]["iduser"])."' AND 
											 		pswd				='".escStringDB($_SESSION["sess"]["user"]["pswd"])."' AND 
											 		nohp1				='".escStringDB($_SESSION["sess"]["user"]["nohp1"])."' AND 
											 		nohp2				='".escStringDB($_SESSION["sess"]["user"]["nohp2"])."' AND 
											 		email1				='".escStringDB($_SESSION["sess"]["user"]["email1"])."' AND 
											 		email2				='".escStringDB($_SESSION["sess"]["user"]["email2"])."'");
			}

			if(!isset($cek) || $cek==0)
			{
				session_destroy();
				unset($_COOKIE["_cid"]);
				setcookie('_cid', null, -1, '/');

				echo '<meta http-equiv="refresh" content="0;url='.siteURL().'login.html" />';
				exit;
			}
		}
		elseif($_SESSION["sess"]["iduser"]==0 && isset($_COOKIE["_cid"]))
		{
			$qry="SELECT * FROM data_login WHERE login_id='".escStringDB($_COOKIE["_cid"])."'";
			if(CekData($qry)>0)
			{
				$data = GetData($qry);
				setParamLogin($data["user_type"],$data["user_id"]);
			}
		}
	}
}