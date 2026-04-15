<?php

if (!function_exists('accessRights_scanFiles'))
{
	function accessRights_scanFiles($pathdir="")
    {
        if($pathdir==""){ /* echo $pathdir; exit; */  }
        elseif(!file_exists($pathdir)){ /* echo $pathdir; exit; */ }
        else
        {
            $lf=listFile($pathdir,"php");
            if($lf!=false)
            {
                $qry='INSERT INTO sys_hak_akses_utama (pathdir,filename) VALUES ';
                foreach ($lf as $filename)
                { 
                    $filename2=str_replace(".php","",$filename);
                    $cekFilename=cekData("sys_hak_akses_utama","pathdir='".$pathdir."' AND filename='".$filename2."'");
                    if(!isset($val)) $val=array();
                    if($cekFilename==0) array_push($val,"('".escStringDB($pathdir)."','".escStringDB($filename2)."')");
                }

                if(isset($val) && count($val)>0)
                {
                    $qry.=join(",",$val);
                    runQuery($qry); /* exit; */
                }/* else{  echo '!$val : '.$pathdir; exit; } */
            }/* else{      echo "FALSE : ".$pathdir; exit; } */
        }
    }
}


if (!function_exists('accessRights'))
{
	function accessRights($subpg="")
	{
        if($subpg=="")  $subpg=$_SESSION["sess"]["subpg"];

		$cek_access_rights=cekData("sys_hak_akses_utama","filename='".escStringDB($subpg)."'");
		$access_rights=getData("sys_hak_akses_utama","filename='".escStringDB($subpg)."'");
		if($cek_access_rights>0){
				$default_access	= $access_rights["default_access"];
				$allow_access	= $access_rights["allow_access"];
				$block_access	= $access_rights["block_access"];
		}
		else	$default_access	= $allow_access	= $block_access	= "[]";

		if($default_access!="") $default_access	= json_decode($default_access,true);	else $default_access = [];
		if($allow_access!="") 	$allow_access	= json_decode($allow_access,true); 		else $allow_access	 = [];
		if($block_access!="") 	$block_access	= json_decode($block_access,true); 		else $block_access	 = [];

		if(		 $_SESSION["sess"]["role"]=="admin")																		        $access=true;
		elseif(	 in_array($_SESSION["sess"]["jabatan"],$default_access) && !in_array($_SESSION["sess"]["iduser"],$block_access))	$access=true;
		elseif(	 in_array($_SESSION["sess"]["jabatan"],$default_access) &&  in_array($_SESSION["sess"]["iduser"],$block_access))	$access=false;
		elseif(	!in_array($_SESSION["sess"]["jabatan"],$default_access) &&  in_array($_SESSION["sess"]["iduser"],$allow_access))	$access=true;
		else																										                $access=false;

		return $access;
	}
}