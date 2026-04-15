<?php

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

if (!function_exists('GetBrowserName'))
{
	function GetBrowserName()
	{
		$user_agent=$_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
		elseif (strpos($user_agent, 'Edge')) return 'Edge';
		elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
		elseif (strpos($user_agent, 'Safari')) return 'Safari';
		elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
		elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'IE';
		else return $user_agent;
	}
}

if (!function_exists('UserAgent'))
{
	function UserAgent($key) #'UserAgent','BrowserName','BrowserVersion','PlatformName','Pattern'
	{
		$u_agent 	= $_SERVER['HTTP_USER_AGENT']; 
		$bname 		= 'Unknown';
		$PlatformName 		= 'Unknown';
		$PlatformVersion	= 'Unknown';
		$version	= "";
	
		//First get the platform?
		//if(preg_match('/windows|win32/i', $u_agent)){ 		$platform = 'Windows'; }
		$os_array = array(	'/Googlebot/i'    		=>  'Bot;Googlebot',
							'/bingbot/i'    		=>  'Bot;Bingbot',
							'/Slurp/i'    			=>  'Bot;Yahoo! Slurp',
							'/cros/i'    			=>  'Chrome;ChromeOS',
							'/windows phone/i'    	=>  'Windows;Windows Phone',
							'/windows nt 10/i'    	=>  'Windows;Win10',
							'/windows nt 6.3/i'     =>  'Windows;Win8.1',
							'/windows nt 6.2/i'     =>  'Windows;Win8',
							'/windows nt 6.1/i'     =>  'Windows;Win7',
							'/windows nt 6.0/i'     =>  'Windows;WinVista',
							'/windows nt 5.2/i'     =>  'Windows;WinServer 2003/XP x64',
							'/windows nt 5.1/i'     =>  'Windows;WinXP',
							'/windows xp/i'         =>  'Windows;WinXP',
							'/windows nt 5.0/i'     =>  'Windows;Win2000',
							'/windows me/i'         =>  'Windows;WinME',
							'/windows 4.90/i'       =>  'Windows;WinMe',
							'/windows nt 4.0/i'     =>  'Windows;WinNT 4.0',
							'/windows 4.00/i'       =>  'Windows;Win95',
							'/windows nt 3.51/i'    =>  'Windows;WinNT 3.51',
							'/windows nt 3.50/i'    =>  'Windows;WinNT 3.50',
							'/windows 3.2/i'        =>  'Windows;Win 3.2',
							'/windows 3.11/i'       =>  'Windows;Win 3.11',
							'/windows nt 3.10/i'    =>  'Windows;WinNT 3.10',
							'/windows 3.10/i'       =>  'Windows;Win 3.10',
							'/windows 3.00/i'       =>  'Windows;Win 3.00',
							'/windows 2.11/i'       =>  'Windows;Win 2.11',
							'/windows 2.10/i'       =>  'Windows;Win 2.10',
							'/windows 2.03/i'       =>  'Windows;Win 2.03',
							'/windows 1.04/i'       =>  'Windows;Win 1.04',
							'/windows 1.03/i'       =>  'Windows;Win 1.03',
							'/windows 1.02/i'       =>  'Windows;Win 1.02',
							'/windows 1.01/i'       =>  'Windows;Win 1.01',
							'/win98/i'              =>  'Windows;Win98',
							'/win95/i'              =>  'Windows;Win95',
							'/win16/i'              =>  'Windows;Win3.11',
							'/iphone os 9/i' 		=>  'Mac;iOS 9 iPhone',
							'/cpu os 9/i' 			=>  'Mac;iOS 9 iPad',
							'/iphone os 8/i' 		=>  'Mac;iOS 8 iPhone',
							'/cpu os 8/i' 			=>  'Mac;iOS 8 iPad',
							'/iphone os 7/i' 		=>  'Mac;iOS 7 iPhone',
							'/cpu os 7/i' 			=>  'Mac;iOS 7 iPad',
							'/iphone os 6/i' 		=>  'Mac;iOS 6 iPhone',
							'/cpu os 6/i' 			=>  'Mac;iOS 6 iPad',
							'/iphone os 5/i' 		=>  'Mac;iOS 5 iPhone',
							'/cpu os 5/i' 			=>  'Mac;iOS 5 iPad',
							'/iphone os 4/i' 		=>  'Mac;iOS 4 iPhone',
							'/cpu os 4/i' 			=>  'Mac;iOS 4 iPad',
							'/iphone os 3/i' 		=>  'Mac;iOS 3 iPhone',
							'/cpu os 3/i' 			=>  'Mac;iOS 3 iPad',
							'/macintosh|mac os x/i' =>  'Mac;Mac OS X',
							'/mac_powerpc/i'        =>  'Mac;Mac OS 9',
							'/linux/i'              =>  'Linux;Linux',
							'/ubuntu/i'             =>  'Ubuntu;Ubuntu',
							'/iphone/i'             =>  'iPhone;iPhone',
							'/ipod/i'               =>  'iPod;iPod',
							'/ipad/i'               =>  'iPad;iPad',
							'/android 7.1/i'        =>  'Android;Android 7.1 Nougat',
							'/android 7.0/i'        =>  'Android;Android 7.0 Nougat',
							'/android 6.0/i'        =>  'Android;Android 6.0 Marshmallow',
							'/android 5.1/i'        =>  'Android;Android 5.1 Lollipop',
							'/android 5.0/i'        =>  'Android;Android 5.0 Lollipop',
							'/android 4.4/i'        =>  'Android;Android 4.4 Kitkat',
							'/android 4.3/i'        =>  'Android;Android 4.3 Jelly Bean',
							'/android 4.2/i'        =>  'Android;Android 4.2 Jelly Bean',
							'/android 4.1/i'        =>  'Android;Android 4.1 Jelly Bean',
							'/android 4.0/i'        =>  'Android;Android 4.0 Ice Cream Sandwich',
							'/android 3.2/i'        =>  'Android;Android 3.2 Honeycomb',
							'/android 3.1/i'        =>  'Android;Android 3.1 Honeycomb',
							'/android 3.0/i'        =>  'Android;Android 3.0 Honeycomb',
							'/android 2.3/i'        =>  'Android;Android 2.3 Gingerbread',
							'/android 2.2/i'        =>  'Android;Android 2.2 Froyo',
							'/android 2.1/i'        =>  'Android;Android 2.1 Eclair',
							'/android 2.0/i'        =>  'Android;Android 2.0 Eclair',
							'/android 1.6/i'        =>  'Android;Android 1.6 Donut',
							'/android 1.5/i'        =>  'Android;Android 1.5 Cupcake',
							'/android 1.1/i'        =>  'Android;Android 1.1 Petit Four',
							'/android 1.0/i'        =>  'Android;Android 1.0 No Name',
							'/blackberry/i'         =>  'BlackBerry;BlackBerry',
							'/webos/i'              =>  'Mobile;Mobile' );
		foreach ($os_array as $regex => $value){ 
			if (preg_match($regex, $u_agent)){ $value=explode(";",$value); $PlatformName=$value[0]; $PlatformVersion=$value[1];}
		}   
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){	$bname = 'Internet Explorer'; 	$ub = "MSIE"; } 
		elseif(preg_match('/Firefox/i',$u_agent)){ 								$bname = 'Mozilla Firefox'; 	$ub = "Firefox"; } 
		elseif(preg_match('/Chrome/i',$u_agent)){ 								$bname = 'Google Chrome'; 		$ub = "Chrome"; } 
		elseif(preg_match('/Safari/i',$u_agent)){ 								$bname = 'Apple Safari'; 		$ub = "Safari"; } 
		elseif(preg_match('/Opera/i',$u_agent)){ 								$bname = 'Opera'; 				$ub = "Opera"; } 
		elseif(preg_match('/Netscape/i',$u_agent)){ 							$bname = 'Netscape'; 			$ub = "Netscape";  } 
		else{																	$bname = ''; 					$ub = "";  } 
		
		// finally get the correct version number
		$known = array('Version',$ub,'other');
		$pattern = '#(?<browser>'.join('|',$known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)){ /* we have no matching number just continue*/ }
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){ $version= $matches['version'][0]; }
			else{ $version= $matches['version'][1]; }
		}
		else{ $version= $matches['version'][0]; }
		
		// check if we have a number
		if ($version==null || $version=="") {$BrowserVersion="?";}
		$UserAgent = array(	'UserAgent'=>$_SERVER['HTTP_USER_AGENT']?:null,
							'PlatformName'=>$PlatformName?:null,
							'PlatformVersion'=>$PlatformVersion?:null,
							'BrowserName'=>$ub?:null,
							'BrowserVersion'=>$version?:null);
		return $UserAgent[$key];
	}
}

if (!function_exists('getUserIP'))
{
	function getUserIP()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) 			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))	$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))		$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))	$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))		$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))			$ipaddress = getenv('REMOTE_ADDR');
		else									$ipaddress = 'unknown';
		return $ipaddress;
	}
}
	
if (!function_exists('OptimizeNSecureForm')) 
{
	function OptimizeNSecureForm($Form)
	{
		//$OptimizeNSecureForm = stripslashes(strip_tags(trim(nl2br($Form))));
		$OptimizeNSecureForm = addslashes(htmlspecialchars(stripslashes(strip_tags(trim($Form)))));
		return $OptimizeNSecureForm;
	}
}
	
if (!function_exists('CleanNumeric')){ function CleanNumeric($VarNum){ return preg_replace("/[^0-9]+/", "", $VarNum); }}
if (!function_exists('FilterNumber')){ function FilterNumber($VarNum){ return CleanNumeric($VarNum); }}
if (!function_exists('FilterDecimal')){ function FilterDecimal($n=0)
{ 
	$n=substr($n,-1)==","?substr($n,0,(strlen($n)-1)):$n;
	$n=str_replace(".","",$n);
	$n=str_replace(",",".",$n);

	return $n;
}}
	
if (!function_exists('FilterAlphaSpace')){ function FilterAlphaSpace($VarNum,$replaceText=""){ return preg_replace('/[^a-zA-Z ]/', $replaceText, $VarNum); }}
if (!function_exists('FilterAlphaDotSpace')){ function FilterAlphaDotSpace($VarNum){ return preg_replace('/[^a-zA-Z .]/', "", $VarNum); }}
	
if (!function_exists('FilterAlnumSpace')){ function FilterAlnumSpace($VarNum){ return preg_replace('/[^0-9a-zA-Z ]/', "", $VarNum); }}
if (!function_exists('FilterAlnumDotSpace')){ function FilterAlnumDotSpace($VarNum){ return preg_replace('/[^0-9a-zA-Z .]/', "", $VarNum); }}

if (!function_exists('CleanAlphaNumeric' )){ function CleanAlphaNumeric($VarNum){  return preg_replace("/[^a-zA-Z0-9]+/", "", $VarNum); }}
if (!function_exists('FilterAlphaNumeric')){ function FilterAlphaNumeric($VarNum){ return CleanAlphaNumeric($VarNum); }}
	
if (!function_exists('FormatNoHP')) 
{
	function FormatNoHP($NoHP,$prefix="62")
	{
		if(strlen($NoHP)>0)
		{
			$NoPe='';
			$JmlhChar = strlen($NoHP);
			for($i=0;$i<$JmlhChar;$i++)
			{
				$CharNoHP = substr($NoHP,$i,1);
				if(is_numeric($CharNoHP))
				{
					$NoPe .= $CharNoHP;
				}
			}
			
			if($prefix=="62")
			{
				if(substr($NoPe,0,2)=="08") 		$NoPe = "62".substr($NoPe,1);
				elseif(substr($NoPe,0,3)=="+08") 	$NoPe = "62".substr($NoPe,2);
			}
			else
			{
				if(substr($NoPe,0,2)=="62") 		$NoPe = "0".substr($NoPe,2);
				elseif(substr($NoPe,0,3)=="+62") 	$NoPe = "0".substr($NoPe,3);/* 
				elseif(substr($NoPe,0,1)!="+" && substr($NoPe,0,1)!="0") $NoPe = "0".$NoPe; */
			}
			
			return $NoPe;
		}
	}
}

if (!function_exists('NoHpFormat')) 
{
	function NoHpFormat($NoHP,$prefix="0")
	{
		return FormatNoHP($NoHP,$prefix);
	}
}
	
if (!function_exists('isNoHP')) 
{
	function isNoHP($NoHP)
	{
		$NoHP=FormatNoHP($NoHP);
		if(substr($NoHP,0,2)=="62" && strlen($NoHP)>=11 && strlen($NoHP)<=14) 	return true;
		elseif(substr($NoHP,0,2)=="62" && strlen($NoHP)<11) 					return false;
		elseif(substr($NoHP,0,2)=="62" && strlen($NoHP)>14) 					return false;
		else
		{
			$cek4digit = filterDataArray($_SESSION["sess"]["country_code"],"code",substr($NoHP,0,4));
			$cek3digit = filterDataArray($_SESSION["sess"]["country_code"],"code",substr($NoHP,0,3));
			$cek2digit = filterDataArray($_SESSION["sess"]["country_code"],"code",substr($NoHP,0,2));
			$cek1digit = filterDataArray($_SESSION["sess"]["country_code"],"code",substr($NoHP,0,1));
			
			return  (strlen($NoHP)>=10 && strlen($NoHP)<=16 && (count($cek4digit)>0 || count($cek3digit)>0 || count($cek2digit)>0 || count($cek1digit)>0))?true:false;
		}
	}
}
	
if (!function_exists('CleanSMS')) 
{
	function CleanSMS($SMS)
	{
		$JmlhChar = strlen($SMS);
		$ValidSMS = "";
		for($i=0;$i<$JmlhChar;$i++)
		{
			$ValidChar = array(	"0","1","2","3","4","5","6","7","8","9",
								"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
								"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
								"`","~","!","@","#","$","%","^","&","*","(",")","-","_","=","+","\\","|","[","]","{","}",";",":","'",'"',"<",">","?","/",",",".",
								" ","\n");
			$CharSMS = substr($SMS,$i,1);
			if(in_array($CharSMS,$ValidChar))
			{
				$ValidSMS .= $CharSMS;
			}
		}
		
		return $ValidSMS;
	}
}
	
if (!function_exists('CleanName')) 
{
	function CleanName($Name)
	{
		$Nama='';
		$ArrayCharName = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",".",","," ");
		$JmlhChar = strlen($Name);
		for($i=0;$i<$JmlhChar;$i++)
		{
			$CharName = substr($Name,$i,1);
			if(in_array(strtolower($CharName),$ArrayCharName))
			{
				$Nama .= $CharName;
			}
		}
		
		return $Nama;
	}
}


if (!function_exists('isValidEmail'))
{
	function isValidEmail($EmailVar)
	{	
		if(filter_var($EmailVar, FILTER_VALIDATE_EMAIL)) $cek=TRUE;
		else $cek=FALSE; return $cek;
	}
}

if (!function_exists('md7'))
{
	function md7($Password)
	{
		$Password = md5($Password);
		$Password = md5(strrev(str_repeat($Password,2)));
		$Password = md5(strtoupper(str_repeat($Password,3)));
		$Password = md5(strrev(str_repeat($Password,5)));
		$Password = md5(strtoupper(str_repeat($Password,7)));
		$Password = md5(strrev(str_repeat($Password,11)));
		$Password = md5(strtoupper(str_repeat($Password,13)));
		$Password = md5(strrev(str_repeat($Password,17)));
		return $Password;
	}
}

if (!function_exists('PasswordEncrypt'))
{
	function PasswordEncrypt($Password)
	{
		$Password = base64_encode(strrev(base64_encode(strrev(base64_encode(strrev(base64_encode($Password)))))));
		return $Password;
	}
}

if (!function_exists('PasswordDecrypt'))
{
	function PasswordDecrypt($Password)
	{
		$Password = base64_decode(strrev(base64_decode(strrev(base64_decode(strrev(base64_decode($Password)))))));
		return $Password;
	}
}


if(!function_exists("KonversiBulanAngka2Huruf"))
{
	function KonversiBulanAngka2Huruf($x)
	{
		$y		= ($x-0);
		$bulan 	= array("1"=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $bulan[$y];
	}
}


if(!function_exists("KonversiBulan"))
{
	function KonversiBulan($x,$display="full-id") # full-id, full-en, 3digit-id, 3digit-en
	{
		$y		= ($x-0);
		$bulan["full-id"] 	= array("1"=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$bulan["3digit-id"] = array("1"=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nov","Des");
		$bulan["full-en"] 	= array("1"=>"January","February","March","April","May","June","July","August","September","October","November","December");
		$bulan["3digit-en"] = array("1"=>"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$bulan=$bulan[$display];
		return $bulan[$y];
	}
}

if(!function_exists("FormatTgl"))
{
	function FormatTgl($varDate,$display="-")
	{
		if(isValidDate(substr($varDate,0,10))){
			if($display=="/")				$varDate = substr($varDate,8,2).'/'.substr($varDate,5,2).'/'.substr($varDate,0,4);
			elseif($display=="full-id")		$varDate = substr($varDate,8,2).' '.KonversiBulan(substr($varDate,5,2),"full-id").' '.substr($varDate,0,4);
			elseif($display=="full-en")		$varDate = substr($varDate,8,2).' '.KonversiBulan(substr($varDate,5,2),"full-en").' '.substr($varDate,0,4);
			elseif($display=="3digit-id")	$varDate = substr($varDate,8,2).' '.KonversiBulan(substr($varDate,5,2),"3digit-id").' '.substr($varDate,0,4);
			elseif($display=="3digit-en")	$varDate = substr($varDate,8,2).' '.KonversiBulan(substr($varDate,5,2),"3digit-en").' '.substr($varDate,0,4);
			else 						 	$varDate = substr($varDate,8,2).'-'.substr($varDate,5,2).'-'.substr($varDate,0,4);
		}
		if(strlen($varDate)==7 && isValidDate($varDate."-01")){
			if($display=="/")				$varDate = substr($varDate,5,2).'/'.substr($varDate,0,4);
			elseif($display=="full-id")		$varDate = KonversiBulan(substr($varDate,5,2),"full-id").' '.substr($varDate,0,4);
			elseif($display=="full-en")		$varDate = KonversiBulan(substr($varDate,5,2),"full-en").' '.substr($varDate,0,4);
			elseif($display=="3digit-id")	$varDate = KonversiBulan(substr($varDate,5,2),"3digit-id").' '.substr($varDate,0,4);
			elseif($display=="3digit-en")	$varDate = KonversiBulan(substr($varDate,5,2),"3digit-en").' '.substr($varDate,0,4);
			else 							$varDate = substr($varDate,5,2).'-'.substr($varDate,0,4);
		}

		if($varDate=="0000-00-00" || $varDate=="0000-00-00 00:00:00") $varDate="";

		return $varDate;
	}
}

if(!function_exists("FormatRangeTgl"))
{
	function FormatRangeTgl($date1="",$date2="",$display="3digit-id")
	{
			if($display=="full-id"){	$separator=" ";	}
		elseif($display=="full-en"){	$separator=" ";	}
		elseif($display=="3digit-id"){	$separator=" ";	}
		elseif($display=="3digit-en"){	$separator=" ";	}
		elseif($display=="-"){			$separator="-";	}
		elseif($display=="/"){			$separator="/";	}
		else{							$separator=" ";	}

		$tgl1 = strtotime($date1)<=strtotime($date2) ? $date1 : $date2;
		$tgl2 = strtotime($date1)> strtotime($date2) ? $date2 : $date2;

		if(substr($tgl1,0,4) != substr($tgl2,0,4))
		{
			$tgl = FormatTgl($tgl1,$display)." - ".FormatTgl($tgl2,$display);
		}
		else if(substr($tgl1,0,7) != substr($tgl2,0,7))
		{
			$t1   = explode($separator,FormatTgl($tgl1,$display));
			$t2   = explode($separator,FormatTgl($tgl2,$display));
			$tgl  = $t1[0].$separator.$t1[1];
			$tgl .= " - ";
			$tgl .= $t2[0].$separator.$t2[1];
			$tgl .= $separator.$t2[2];
		}
		else if(substr($tgl1,0,10) != substr($tgl2,0,10))
		{
			$t1   = explode($separator,FormatTgl($tgl1,$display));
			$t2   = explode($separator,FormatTgl($tgl2,$display));
			$tgl  = $t1[0]."-".$t2[0];
			$tgl .= $separator.$t2[1].$separator.$t2[2];
		}
		else
		{
			$tgl = FormatTgl($tgl1,"3digit-id");
		}

		return $tgl??"-";
	}
}

if(!function_exists("FormatTglDb"))
{
	function FormatTglDb($varDate)
	{
		$varDate = substr($varDate,6,4).'-'.substr($varDate,3,2).'-'.substr($varDate,0,2);
		return $varDate;
	}
}

if(!function_exists("isValidDate"))
{
	function isValidDate($date, $format = 'Y-m-d')
	{
		//return validateDate($date, $format = 'Y-m-d');
        
        // if(strlen($date)==10){
        //     $y=substr($date,0,4);
        //     $m=substr($date,5,2);
        //     $d=substr($date,8,2); 
        //     $r=checkdate($m, $d, $y);
        // }else{ $r=false; }
        // return $r;

		$dateObj = DateTime::createFromFormat($format, $date);
    	return $dateObj && $dateObj->format($format) == $date;
	}
}

if(!function_exists("FormatWaktu"))
{
	function FormatWaktu($varTime,$Display="JamMenit")
	{
		if($varTime!=""){
			if(strtolower($Display)=="full") 	$varTime=substr($varTime,11);
			else								$varTime=substr($varTime,11,5);
		}
		return $varTime;
	}
}use function FormatWaktu as WaktuFormat;

if(!function_exists("FormatJam"))
{
	function FormatJam($varTime,$Display="JamMenit")
	{
		return FormatWaktu($varTime,$Display);
	}
}use function FormatJam as JamFormat;

if(!function_exists("FormatDate"))
{
	function FormatDate($varDate)
	{
		if($varDate!="") $varDate = substr($varDate,8,2).'/'.substr($varDate,5,2).'/'.substr($varDate,0,4);
		return $varDate;
	}
}use function FormatDate as DateFormat;

if(!function_exists("FormatDate2"))
{
	function FormatDate2($varDate)
	{
		if($varDate!="") $varDate = substr($varDate,8,2).' '.KonversiBulanAngka2Huruf(substr($varDate,5,2)).' '.substr($varDate,0,4);
		return $varDate;
	}
}use function FormatDate2 as DateFormat2;

if(!function_exists("FormatTime"))
{
	function FormatTime($varTime)
	{
		if($varTime!="") $varTime = substr($varTime,11);
		return $varTime;
	}
}use function FormatTime as TimeFormat;


if(!function_exists("FormatTglWaktu"))
{
	function FormatTglWaktu($dateTime,$opsi=array("tgl"=>"","wkt"=>""))
	{
		if(!isset($opsi["tgl"])) $opsi["tgl"]="";
		if(!isset($opsi["wkt"])) $opsi["wkt"]="";
		return FormatTgl($dateTime,$opsi["tgl"])." ".FormatWaktu($dateTime,$opsi["wkt"]);
	}
}



if(!function_exists("DayByDate"))
{
	function DayByDate($varDate="-")
	{
		if($varDate=="-") $varDate=date("Y-m-d");
		$day=date('D', strtotime(date($varDate)));
		$hari=array("Mon"=>"Senin","Tue"=>"Selasa","Wed"=>"Rabu","Thu"=>"Kamis","Fri"=>"Jumat","Sat"=>"Sabtu","Sun"=>"Minggu");
		return $hari[$day];
	}
}


if(!function_exists("umur"))
{
	function umur($birthDate="",$pointDate="")
	{
		if($birthDate=="") $birthDate=date("Y-m-d");
		if($pointDate=="") $pointDate=date("Y-m-d");

		# object oriented
		$birthDate = new DateTime($birthDate);
		$pointDate = new DateTime($pointDate);
		$age  	   = $birthDate->diff($pointDate)->y;

		# procedural
		# echo date_diff(date_create($birthDate), date_create($pointDate))->y;

		return $age;
	}
}

if(!function_exists("DateTimezoneUser"))
{
	// inputnya timestamp, default outputnya format tanggal db
	function DateTimezoneUser($timestamp="default", $end_timezone_string="default", $start_timezone_string="default", $date_format="Y-m-d H:i:s")
	{
		$timestamp_to_convert	= $timestamp=="default" ? time() : $timestamp;

		// database default timezone 
		$data_default_timezone	= isset($_SESSION["sess"]["data_default_timezone"]) ? $_SESSION["sess"]["data_default_timezone"] : (($timestamp=="default") ? date_default_timezone_get() : "UTC");
		$start_timezone_string	= $start_timezone_string=="default" ? $data_default_timezone : $start_timezone_string;

		// user default timezone
		$user_default_timezone	= isset($_SESSION["sess"]["user_default_timezone"]) ? $_SESSION["sess"]["user_default_timezone"] : date_default_timezone_get();
		$end_timezone_string	= $end_timezone_string=="default" ? $user_default_timezone : $end_timezone_string;

		return konversiTimezone($timestamp_to_convert, $start_timezone_string, $end_timezone_string, $date_format);
	}
}

if(!function_exists("DateTimezoneDB"))
{
	// inputnya format tanggal db, outputnya timestamp
	function DateTimezoneDB($date_time="", $start_timezone_string="default", $end_timezone_string="default", $date_format=null)
	{
		$timestamp_to_convert	= $date_time=="" ? strtotime(gmdate("Y-m-d H:i:s",time())) : strtotime(gmdate("Y-m-d H:i:s",strtotime($date_time)));
		
		// user default timezone
		$user_default_timezone	= isset($_SESSION["sess"]["user_default_timezone"]) ? $_SESSION["sess"]["user_default_timezone"] : date_default_timezone_get();	
		$start_timezone_string	= $start_timezone_string=="default" ? $user_default_timezone : $start_timezone_string;

		// database default timezone 
		$data_default_timezone	= isset($_SESSION["sess"]["data_default_timezone"]) ? $_SESSION["sess"]["data_default_timezone"] : "UTC";
		$end_timezone_string	= $end_timezone_string=="default" ? $data_default_timezone : $end_timezone_string;

		return konversiTimezone($timestamp_to_convert, $start_timezone_string, $end_timezone_string, $date_format);
	}
}

if(!function_exists("konversiTimezone"))
{
	function konversiTimezone($timestamp_to_convert=null, $start_timezone_string="default", $end_timezone_string="default", $date_format=null)
	{

		// We require a start time
		if(empty($timestamp_to_convert)) return false;
		
		// If the two timezones are different, find the offset
		if( $start_timezone_string != $end_timezone_string )
		{
			// Create two timezone objects, one for the start and one for the end
			$dateTimeZoneStart 	= new DateTimeZone( $start_timezone_string );
			$dateTimeZoneEnd 	= new DateTimeZone( $end_timezone_string );
			
			// Create two DateTime objects that will contain the same Unix timestamp, but
			// have different timezones attached to them.
			$dateTimeStart 	= new DateTime( "now", $dateTimeZoneStart );
			$dateTimeEnd 	= new DateTime( "now", $dateTimeZoneEnd );
			
			// Calculate the GMT offset for the date/time contained in the $dateTimeStart
			// object, but using the timezone rules as defined for the end timezone ($dateTimeEnd)
			$timeOffset 	= $dateTimeZoneEnd->getOffset($dateTimeStart);	
		} 
		else $timeOffset = 0; // If the timezones are the same, there is no offset
		
		// Convert the time by the offset
		$converted_time = $timestamp_to_convert + $timeOffset;
		
		// If we have no given format, just return the time
		if(empty($date_format)) return $converted_time;
		
		// Convert to the given date format
		return date($date_format, $converted_time);
	}
}

if(!function_exists("DateRangeTimestampDB"))
{
	function DateRangeTimestampDB($col=null,$startDate=null,$endDate=null,$startTime=null,$endTime=null)
	{
		if(empty($startDate)) 	$startDate	= date("Y-m-d");
		if(empty($endDate)) 	$endDate	= date("Y-m-d");
		if(empty($startTime)) 	$startTime	= "00:00:00";
		if(empty($endTime)) 	$endTime	= "23:59:59";

		if(!empty($col)) $a="($col>='".DateTimezoneDB($startDate." ".$startTime)."' AND $col<='".DateTimezoneDB($endDate." ".$endTime)."')";
		else $a="";

		return $a;
	}
}


if(!function_exists("NumberFormat"))
{
	function NumberFormat($varNum,$intDec=0,$decimalpoint=",")
	{
		if($decimalpoint==",") $varNum = number_format($varNum,$intDec,',','.');
		else $varNum = number_format($varNum,$intDec,'.',',');
		return $varNum;
	}
}
use function NumberFormat as FormatNumber;

if(!function_exists("RupiahFormat"))
{
	function RupiahFormat($varNum,$intDec=0)
	{
		$varNum = '<span style="font-size:smaller;">Rp</span>'.NumberFormat($varNum,$intDec).',-';
		return $varNum;
	}
}
use function RupiahFormat as FormatRupiah;

if(!function_exists("DateBySecond"))
{
	function DateBySecond($VarSecond,$op="",$PointDate="")
	{
		if($PointDate=="") 	$PointDate = time();
		else				$PointDate = strtotime($PointDate);
		if($op=="-") 		$next = $PointDate-($VarSecond);
		elseif($op=="+") 	$next = $PointDate+($VarSecond);
		else				$next = $PointDate+($VarSecond);
		$DateTime = date('Y-m-d H:i:s', $next);
		return $DateTime;
	}
}

if(!function_exists("BisnisDate"))
{
	function BisnisDate($n=1,$PointDate="",$op="+") // $n=jumlah hari 
	{
		if($PointDate=="") 	$PointDate = time();
		else				$PointDate = strtotime($PointDate);
		$i=0;$d=1;//$hari=$hari2="";
		while($n>=$d) {	
			$i++; if($op=="+") $tgl=$PointDate+($i*86400); else $tgl=$PointDate-($i*86400);
			$hari=date("D",$tgl); if($hari!="Sat" && $hari!="Sun"){ $d++; } //$hari2.=$d."-".$hari.',';
		}
		if($op=="+") $tgl=$PointDate+($i*86400); else $tgl=$PointDate-($i*86400);
		return date("Y-m-d H:i:s",$tgl);//." *** ".$hari2;
	}
}

if(!function_exists("WorkingDate"))
{
	function WorkingDate($n=1,$PointDate="",$op="+") // $n=jumlah hari
	{
		if($PointDate=="") 	$PointDate = time();
		else				$PointDate = strtotime($PointDate);
		$i=0;$d=1;//$hari=$hari2="";
		while($n>=$d) {	
			$i++; if($op=="+") $tgl=$PointDate+($i*86400); else $tgl=$PointDate-($i*86400);
			$hari=date("D",$tgl); if($hari!="Sun"){ $d++; } //$hari2.=$d."-".$hari.',';
		}
		if($op=="+") $tgl=$PointDate+($i*86400); else $tgl=$PointDate-($i*86400);
		return date("Y-m-d H:i:s",$tgl);//." *** ".$hari2;
	}
}

if(!function_exists("HitungHari"))
{
	function HitungHari($date1="",$date2 = "",$type="",$pembulatan="")
	{
		if($date1=="") return "";
		else if($type=="BussinesDate")
		{
			$a=$i=1; $x=0; $dateA=strtotime($date1); $dateB=strtotime($date2);
			if($dateA<$dateB){ $start=$date1; $end=$date2; }
			else{ $start=$date2; $end=$date1; }

			while($a==1)
			{
				$date=date('Y-m-d H:i:s', strtotime($start . ' +'.$i.' day'));
				if(strtotime($date)<=strtotime($end))
				{
					if(DayByDate($date)!="Sabtu" && DayByDate($date)!="Minggu") $x++;
				}
				else $a=0;
				$i++;
			} return $x;
		}
		else{
			if($date1=="") $date1=time(); else $date1=strtotime($date1);
			$date2=strtotime($date2);
			if($date2>=$date1)$datediff=$date2-$date1;
			else $datediff=$date1-$date2;

			if($pembulatan=="up") 		return ceil($datediff/(60*60*24));
			elseif($pembulatan=="down") return floor($datediff/(60*60*24));
			else						return round($datediff/(60*60*24));	
		}
	}
}


if(!function_exists("SatuanWaktu"))
{
	function SatuanWaktu($detik=0,$satuan="")
	{
		$r="";
		if($detik==0) 							$r="";
		elseif($detik>0 && $detik<60)			$r=$detik." detik";
		elseif($detik>=60 && $detik<3600)		$r=floor($detik/60)." menit ".SatuanWaktu(($detik%60));
		elseif($detik>=3600 && $detik<86400)	$r=floor($detik/3600)." jam ".SatuanWaktu(($detik%3600));
		elseif($detik>=86400)					$r=floor($detik/86400)." hari ".SatuanWaktu(($detik%86400));
		elseif($detik>=(86400*30))				$r=floor($detik/86400)." bulan ".SatuanWaktu(($detik%(86400*30)));
		elseif($detik>=(86400*30*12))			$r=floor($detik/86400)." tahun ".SatuanWaktu(($detik%(86400*30*12)));

		return trim($r);
	}
}


if(!function_exists("DurasiWaktu"))
{
	function DurasiWaktu($detik=0,$satuan="")
	{ return SatuanWaktu($detik,$satuan); }
}


if(!function_exists("KonversiWaktu"))
{
	function KonversiWaktu($num1=0,$sat1="",$sat2="")
	{ 
			if($sat1=="tahun") 	$num2=$num1*86400*30*12;
		elseif($sat1=="bulan") 	$num2=$num1*86400*30;
		elseif($sat1=="hari") 	$num2=$num1*86400;
		elseif($sat1=="jam") 	$num2=$num1*3600;
		elseif($sat1=="menit") 	$num2=$num1*60;
		else					$num2=$num1;

			if($sat2=="tahun")	$num2=floor($num2/(86400*30*12))." tahun ".	($num2%(86400*30*12)>0 ? KonversiWaktu($num2%(86400*30*12),"detik","bulan") : "");
		elseif($sat2=="bulan")	$num2=floor($num2/(86400*30))." bulan ".	($num2%(86400*30)>0 ? KonversiWaktu($num2%(86400*30),"detik","hari") : "");
		elseif($sat2=="hari")	$num2=floor($num2/(86400))." hari ".		($num2%(86400)>0 ? KonversiWaktu($num2%(86400),"detik","jam") : "");
		elseif($sat2=="jam")	$num2=floor($num2/(3600))." jam ".			($num2%(3600)>0 ? KonversiWaktu($num2%(3600),"detik","menit") : "");
		elseif($sat2=="menit")	$num2=floor($num2/(60))." menit ".			($num2%(60)>0 ? ($num2%60)." detik" : "");
		else					$num2=$num2." detik";


		return $num2; 
	}
}

if(!function_exists("FindInString"))
{
	function FindInString($findme,$mystring)
	{
		$pos=strpos($mystring,$findme);
		
		// Note our use of ===.  Simply == would not work as expected
		// because the position of 'a' was the 0th (first) character.
		if ($pos===false) 
		{
			$Found=false;
		}
		else
		{
			$Found=true;
		}		
		return $Found;
	}
}


if (!function_exists('image_type'))
{
	function image_type($type)
	{
		if($type=="1") 		$type_desc="GIF";
		elseif($type=="2") 	$type_desc="JPG";
		elseif($type=="3") 	$type_desc="PNG";
		elseif($type=="4") 	$type_desc="SWF";
		elseif($type=="5") 	$type_desc="PSD";
		elseif($type=="6") 	$type_desc="BMP";
		elseif($type=="7") 	$type_desc="TIFF (intel byte order)";
		elseif($type=="8") 	$type_desc="TIFF (motorola byte order)";
		elseif($type=="9") 	$type_desc="JPC";
		elseif($type=="10") $type_desc="JP2";
		elseif($type=="11") $type_desc="JPX";
		elseif($type=="12") $type_desc="JB2";
		elseif($type=="13") $type_desc="SWC";
		elseif($type=="14") $type_desc="IFF";
		elseif($type=="15") $type_desc="WBMP";
		elseif($type=="16") $type_desc="XBM";
		else				$type_desc="Unknown";
			
		return $type_desc;
	}
}
if (!function_exists('KonversiTerbilang'))
{
	function KonversiTerbilang($x)
	{
		$x=(int) $x;
	  $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	  if ($x==0)					return "";
	  elseif ($x>0 && $x<12)		return " ".$angka[$x]." ";
	  elseif ($x < 20)				return Terbilang($x-10)." belas ";
	  elseif ($x < 100)				return Terbilang($x/10)." puluh ".Terbilang($x%10);
	  elseif ($x < 200)				return " seratus ".Terbilang($x-100);
	  elseif ($x < 1000)			return Terbilang($x/100)." ratus ".Terbilang($x%100);
	  elseif ($x < 2000)			return " seribu ".Terbilang($x-1000);
	  elseif ($x < 1000000)			return Terbilang($x/1000)." ribu ".Terbilang($x%1000);
	  elseif ($x < 1000000000)		return Terbilang($x/1000000)." juta ".Terbilang($x%1000000);
	  elseif ($x <= 2147483647)		return Terbilang($x/1000000000)." milyar ".Terbilang($x%1000000000);
	  #-> 2.147.483.647 at maximum for integer type.
	  elseif (strlen($x)==10)		return Terbilang(floatval(substr($x,0,1)))." miliar ".Terbilang(floatval(substr($x,1)));
	  elseif (strlen($x)==11)		return Terbilang(floatval(substr($x,0,2)))." miliar ".Terbilang(floatval(substr($x,2)));
	  elseif (strlen($x)==12)		return Terbilang(floatval(substr($x,0,3)))." miliar ".Terbilang(floatval(substr($x,3)));
	  elseif (strlen($x)==13)		return Terbilang(floatval(substr($x,0,1)))." triliun ".Terbilang(floatval(substr($x,1)));
	  elseif (strlen($x)==14)		return Terbilang(floatval(substr($x,0,2)))." triliun ".Terbilang(floatval(substr($x,2)));
	  elseif (strlen($x)==15)		return Terbilang(floatval(substr($x,0,3)))." triliun ".Terbilang(floatval(substr($x,3)));
	  elseif (strlen($x)==16)		return 	Terbilang(floatval(substr($x,0,1)))." kuadriliun ".
											Terbilang(floatval(substr($x,1,3)))." triliun ".
											Terbilang(floatval(substr($x,4)));
	  elseif (strlen($x)==17)		return 	Terbilang(floatval(substr($x,0,2)))." kuadriliun ".
											Terbilang(floatval(substr($x,2,3)))." triliun ".
											Terbilang(floatval(substr($x,5)));
	  elseif (strlen($x)==18)		return 	Terbilang(floatval(substr($x,0,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,3,3)))." triliun ".
											Terbilang(floatval(substr($x,6)));
	  elseif (strlen($x)==19)		return 	Terbilang(floatval(substr($x,0,1)))." kuintiliun ".
											Terbilang(floatval(substr($x,1,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,4,3)))." triliun ".
											Terbilang(floatval(substr($x,7)));
	  elseif (strlen($x)==20)		return 	Terbilang(floatval(substr($x,0,2)))." kuintiliun ".
											Terbilang(floatval(substr($x,2,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,5,3)))." triliun ".
											Terbilang(floatval(substr($x,8)));
	  elseif (strlen($x)==21)		return 	Terbilang(floatval(substr($x,0,3)))." kuintiliun ".
											Terbilang(floatval(substr($x,3,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,6,3)))." triliun ".
											Terbilang(floatval(substr($x,9)));
	  elseif (strlen($x)==22)		return 	Terbilang(floatval(substr($x,0,1)))." sekstiliun ". #elseif ($x <= 2361991123455999737856)
											Terbilang(floatval(substr($x,1,3)))." kuintiliun ".
											Terbilang(floatval(substr($x,4,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,7,3)))." triliun ".
											Terbilang(floatval(substr($x,10)));
	  elseif (strlen($x)==23)		return 	Terbilang(floatval(substr($x,0,2)))." sekstiliun ".
											Terbilang(floatval(substr($x,2,3)))." kuintiliun ".
											Terbilang(floatval(substr($x,5,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,8,3)))." triliun ".
											Terbilang(floatval(substr($x,11)));
	  elseif (strlen($x)==24)		return 	Terbilang(floatval(substr($x,0,3)))." sekstiliun ".
											Terbilang(floatval(substr($x,3,3)))." kuintiliun ".
											Terbilang(floatval(substr($x,6,3)))." kuadriliun ".
											Terbilang(floatval(substr($x,9,3)))." triliun ".
											Terbilang(floatval(substr($x,12)));
	  else							return "Out of range";
	  
	  # 2361991123455999737856
	  
	}
}


if (!function_exists('AngkaRomawi'))
{
	function AngkaRomawi($angka)
	{

		// M=1000
		// D=500
		// C=100
		// L=50
		// X=10
		// V=5
		// I=1
		
		$hsl = "";
		if ($angka < 1 || $angka > 5000) { 
			// Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
			$hsl = "Batas Angka 1 s/d 5000";
		} else {
			while ($angka >= 1000) {
				// While itu termasuk kedalam statement perulangan
				// Jadi misal variable angka lebih dari sama dengan 1000
				// Kondisi ini akan di jalankan
				$hsl .= "M"; 
				// jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
				// Varible hsl
				$angka -= 1000;
				// Lalu setelah itu varible angka di kurangi 1000 ,
				// Kenapa di kurangi
				// Karena statment ini mengambil 1000 untuk di konversi menjadi M
			}
		}


		if ($angka >= 500) {
			// statement di atas akan bernilai true / benar
			// Jika var angka lebih dari sama dengan 500
			if ($angka > 500) {
				if ($angka >= 900) {
					$hsl .= "CM";
					$angka -= 900;
				} else {
					$hsl .= "D";
					$angka-=500;
				}
			}
		}
		while ($angka>=100) {
			if ($angka>=400) {
				$hsl .= "CD";
				$angka -= 400;
			} else {
				$angka -= 100;
			}
		}
		if ($angka>=50) {
			if ($angka>=90) {
				$hsl .= "XC";
				$angka -= 90;
			} else {
				$hsl .= "L";
				$angka-=50;
			}
		}
		while ($angka >= 10) {
			if ($angka >= 40) {
				$hsl .= "XL";
				$angka -= 40;
			} else {
				$hsl .= "X";
				$angka -= 10;
			}
		}
		if ($angka >= 5) {
			if ($angka == 9) {
				$hsl .= "IX";
				$angka-=9;
			} else {
				$hsl .= "V";
				$angka -= 5;
			}
		}
		while ($angka >= 1) {
			if ($angka == 4) {
				$hsl .= "IV"; 
				$angka -= 4;
			} else {
				$hsl .= "I";
				$angka -= 1;
			}
		}

		return ($hsl);
	}
}

if (!function_exists('Terbilang'))
{
	function Terbilang($x)
	{
		//return str_replace("  "," ",trim(ucwords(KonversiTerbilang($x))));
		$a=trim(ucwords(KonversiTerbilang($x)));
		$a=str_replace("      "," ",$a);
		$a=str_replace("     "," ",$a);
		$a=str_replace("    "," ",$a);
		$a=str_replace("   "," ",$a);
		$a=str_replace("  "," ",$a);
		return $a;
	}
}

if (!function_exists('check_urlfb'))
{
	function check_urlfb($field){
		if(!preg_match('/^(http\:\/\/|https\:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w\.)*#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)/', $field)){
			return 0;
		}
		return 1;
	}
}

if (!function_exists('check_idtwitter'))
{
	function check_idtwitter($field){
		if(!preg_match('/^(\@)?[A-Za-z0-9_]+$/', $field) || strlen($field)>15){
			return 0;
		}
		return 1;
	}
}

if (!function_exists('UrlText'))
{
	function UrlText($txt)
	{
		$x='';
		$txt=strtolower(trim($txt));
		
		$ValidChar = array(	"0","1","2","3","4","5","6","7","8","9",
							"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
							"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		
		for($i=0;$i<strlen($txt);$i++){
			$t=$txt[$i];
			#if(ctype_alnum($t)) $x.=$t;			
			if(in_array($t,$ValidChar)) $x.=$t;
			elseif($t=="+") $x.="-plus-";
			elseif($t=="&") $x.="-dan-";
			elseif(	$t=="-" || 
					$t==" " || 
					$t=="/" || 
					$t=="_" || 
					$t=="." || 
					$t==",") $x.='-';
		}
		$x = str_replace("--","-",$x);
		if(substr($x,-1)=="-") 	$x = substr($x,0,(strlen($x)-1));
		if(substr($x,0,1)=="-") $x = substr($x,1);
		return $x;
	}
}

if (!function_exists('ArrEnum'))
{
	function ArrEnum($table,$column)
	{
		$sql = "SHOW COLUMNS FROM ".$table." LIKE '".$column."'";
		if ($result = mysqli_query($_SESSION["sess"]["koneksi"],$sql))
		{
			$enum = mysqli_fetch_object($result);
			$r = $enum->Type;
			$r = str_replace("enum(","",$r);
			$r = str_replace(")","",$r);
			$r = str_replace("'","",$r);
			$r = explode(",",$r);
			return $r;
		}
	}
}

if (!function_exists('JumlahData'))
{
	function JumlahData($table,$where="x")
	{
		if($where=="x") $qry=$table;
		else $qry = "SELECT * FROM ".$table." WHERE ".$where;
		$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);// or die("[ERROR] JumlahData Function"/*.$qry*/);
		return $JumlahData=mysqli_num_rows($mqr);
	}
}

if (!function_exists('getData'))
{
	function getData($table,$where="",$column="")
	{
		//$qry = "SELECT * FROM ".$table." WHERE ".$where;
		if($where=="x" || $where=="") $qry=$table;
		else $qry = "SELECT * FROM ".$table." WHERE ".$where;
		$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);// or die("[ERROR] getData Function");
		if(runQuery($qry)){}
		else
		{
			$txt = $qry."\n".mysqli_error($_SESSION["sess"]["koneksi"]);
			logFile($txt,__LINE__,"function getData");
		}
		
		if($column=="all")
		{ 
			$allRow=$dataRow=array();
			while($mfa=mysqli_fetch_assoc($mqr)) array_push($dataRow,$mfa);

			$allRow["data"]=$dataRow;
			$allRow["mnr"]=$allRow["jumlah"]=$allRow["total"]=$allRow["count"]=mysqli_num_rows($mqr);
			return $allRow;
		}
		elseif($column!="")
		{ 
			$GetData=mysqli_fetch_assoc($mqr);
		 	if(isset($GetData[$column])) return $GetData[$column];
			else return "";
		}
		else
		{
			$allRow = $GetData=mysqli_fetch_assoc($mqr);
			return $allRow;
		}
	}
}

if (!function_exists('getInsertId'))
{
	function getInsertId()
	{
		return mysqli_insert_id($_SESSION["sess"]["koneksi"]);
	}
}

if (!function_exists('escStringDB'))
{
	function escStringDB($var,$conn=null)
	{
		$conn=$conn!=null?$conn:(isset($_SESSION["sess"]["koneksi"])?$_SESSION["sess"]["koneksi"]:null);
		return $conn!=null?mysqli_real_escape_string($conn,$var):$var;
	}
}

if (!function_exists('getDataArray'))
{
	function getDataArray($arr,$findKey="",$findValue="",$requestKey="all")
	{
		if(is_array($arr))
		{
			foreach($arr AS $key=>$val)
			{ 
				if(is_array($arr[$key]))
				{
					if($arr[$key][$findKey]==$findValue || $findValue=="")
					{
						if($findValue=="")						$returnValue=$arr[$key][$findKey];
						elseif($requestKey=="all")				$returnValue=$arr[$key];
						elseif(isset($arr[$key][$requestKey]))	$returnValue=$arr[$key][$requestKey];
						break;
					} 	
				}
				else break;
			}
		}

		if(isset($returnValue)) return $returnValue; else return [];
	}
}

if (!function_exists('filterDataArray'))
{
	function filterDataArray($arr,$filterKey="",$filterValue="",$substrStart=0,$substrEnd=0)
	{
		if(is_array($filterValue)) $arrReturn = filterDataArray_multiValue($arr,$filterKey,$filterValue,$substrStart,$substrEnd);
		elseif(is_array($arr) && count($arr)>0 && $filterKey!="")
		{
			$_SESSION["sess"]["filterKey"]		= $filterKey;
			$_SESSION["sess"]["substrStart"]	= $substrStart;
			$_SESSION["sess"]["substrEnd"]		= $substrEnd;

			if($filterValue=="null")
			{
				$arrReturn=[];
				foreach($arr AS $data)
				{
					if(is_null($data[$filterKey])) array_push($arrReturn,$data);
				}
			}
			else if($filterValue!="")
			{
				if($substrEnd>0)	$arrReturn = array_filter($arr, function ($var) use ($filterValue){ return (trim(strtolower(substr($var[$_SESSION["sess"]["filterKey"]],$_SESSION["sess"]["substrStart"],$_SESSION["sess"]["substrEnd"]))) 	== trim(strtolower($filterValue))); });
				else				$arrReturn = array_filter($arr, function ($var) use ($filterValue){ return (trim(strtolower($var[$_SESSION["sess"]["filterKey"]]??"")) 																		== trim(strtolower($filterValue))); });
			}
		}

		if(isset($arrReturn)) return $arrReturn; else return [];
	
	}
}

if (!function_exists('filterDataArray_multiValue'))
{
	function filterDataArray_MultiValue($arr,$filterKey="",$filterValue=[],$substrStart=0,$substrEnd=0)
	{
		$arrReturn=[];
		foreach($filterValue AS $val)
		{
			$a=filterDataArray($arr,$filterKey,$val,$substrStart,$substrEnd);
			foreach($a AS $b){ array_push($arrReturn,$b); }
		}

		return $arrReturn;
	}
}

if (!function_exists('firstDataArray'))
{
	function firstDataArray($arr)
	{	// data pertama multidimensional array
		$v=array(); $i=0;
		if(is_array($arr)){ foreach($arr AS $key=>$val){ $v[$i]=$val; $i++; }}

		return $v[0]??$v;
	}
}

if (!function_exists('sortDataArray_byValue'))
{
	function sortDataArray_byValue($array, $col, $dir = SORT_ASC) 
	{
		$sort_col = array();
		foreach ($array as $key => $row) { $sort_col[$key] = $row[$col]; }
	
		array_multisort($sort_col, $dir, $array);
		return $array;
	}
}

if (!function_exists('addValueToArrayByKeyPath'))
{
	function addValueToArrayByKeyPath ($array, $keyPath, $value) 
	{
		if (!is_array($array)) throw new \InvalidArgumentException;
	
		$level =& $array;
		foreach ($keyPath as $key)
		{
			if (!array_key_exists($key, $level) or !is_array($level[$key])) { $level[$key] = []; }
			$level =& $level[$key];
		}
		$level = $value;
	
		return $array;
	}
}

if (!function_exists('cekData'))
{
	function cekData($table,$where="")
	{
		/* $qry="SELECT * FROM ".$table;
		if($where!="")$qry.=" WHERE ".$where; */
		if($where=="") $qry=$table;
		else $qry = "SELECT * FROM ".$table." WHERE ".$where;

		$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);// or die("[ERROR] cekData Function".mysqli_error($_SESSION["sess"]["koneksi"]) );
		if($mqr) return $cekData=mysqli_num_rows($mqr);
		else
		{
			$txt = $qry."\n".mysqli_error($_SESSION["sess"]["koneksi"]);
			logFile($txt,__LINE__,"function cekData");
		}
	}
}

if (!function_exists('runQuery'))
{
	function runQuery($qry)
	{
		if($qry=="") return false;
		else
		{
			$qryRun=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
			if($qryRun){ return true; }
			else{
				$txt = $qry."\n".mysqli_error($_SESSION["sess"]["koneksi"]);
				logFile($txt,__LINE__,"function runQuery");
				return false;  
			} /* logFile($qry,__LINE__,"function runQuery"); */
		}
	}
}

if (!function_exists('logFile'))
{
	function logFile($txt="log text",$line=__LINE__,$desc="")
	{
		if(!is_numeric($line)) $line=__LINE__;
		if($desc!="") $desc="-".UrlText($desc);

		$folder 	= "!log-file-".md5("logFile")."/";
		if(!file_exists($folder)) mkdir($folder);
		if(!file_exists($folder."index.html")) fopen($folder."index.html","w");

		/* $user = marketing($_SESSION["sess"]["base_profile"],$_SESSION["sess"]["iduser"]);
		$nama = $user["nama"]; if($nama=="") */ $nama="user";

		$folder 	= $folder.$nama."/";
		if(!file_exists($folder)) mkdir($folder);
		if(!file_exists($folder."index.html")) fopen($folder."index.html","w");

		$filename	= date("ymd-His")."---".basename(__FILE__, '.php')."---line-".$line.$desc.".txt";
		if(!file_exists($filename)) fopen($folder.$filename, "w");
		$myfile = fopen($folder.$filename, "w");// or die("Unable to open file!");
		
		$txt = is_array($txt) ? json_encode($txt) : $txt;
		fwrite($myfile, $txt);
		fclose($myfile);
	}
}

if (!function_exists('runMultiQuery'))
{
	function runMultiQuery($qry)
	{
		/* $qryRun=mysqli_multi_query($_SESSION["sess"]["koneksi"],$qry);
		if($qryRun){ return true; }
		else{
			
			$txt = $qry."\n".mysqli_error($_SESSION["sess"]["koneksi"]);
			logFile($txt,__LINE__,"function runMultiQuery");			
            return false;  
		}
		mysqli_free_result($qryRun); */



		if (mysqli_multi_query($_SESSION["sess"]["koneksi"], $qry)) 
		{
			do {
			  // Store first result set
			  if ($result = mysqli_use_result($_SESSION["sess"]["koneksi"])) {
				/* while ($row = mysqli_fetch_row($result)) {
				  printf("%s\n", $row[0]);
				} */
				mysqli_free_result($result);
			  }
			  // if there are more result-sets, the print a divider
			  /* if (mysqli_more_results($_SESSION["sess"]["koneksi"])) {
				printf("-------------\n");
			  } */
			   //Prepare next result set
			} while (mysqli_next_result($_SESSION["sess"]["koneksi"]) && mysqli_more_results($_SESSION["sess"]["koneksi"]));
			
			return true; 
		
		}else{
				
			$txt = $qry."\n".mysqli_error($_SESSION["sess"]["koneksi"]);
			logFile($txt,__LINE__,"function runMultiQuery");
			return false;  
		}
	}
		
}

if (!function_exists('inisial'))
{
	function inisial($txt="",$case="")
	{
		if($txt!="")
		{
			$txt=explode(" ",trim($txt));$inisal="";
			for($i=0;$i<count($txt);$i++)
			{
				$inisal.=substr($txt[$i],0,1);
			}
			if($case=="ucase")  $inisal=strtoupper($inisal);
			elseif($case=="lcase")  $inisal=strtolower($inisal);
		}else $inisal="";
		
		return $inisal;
	}
}

if (!function_exists('persentase'))
{
	function persentase($a1=1,$a2=1,$postSymbol="%")
	{
		if($a2>0)$a=round(($a1*100)/$a2);
		else $a=0;
		return $a.$postSymbol;
	}
}

if (!function_exists('domainNAME'))
{
	function domainNAME()
	{
		return $_SERVER['HTTP_HOST'];
	}

}

if (!function_exists('siteURL'))
{
	function siteURL($a="/")
	{
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		return $protocol.domainNAME().$a;
	}
}

if (!function_exists('fullSiteURL'))
{
	function fullSiteURL()
	{
		return  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
}

if(!function_exists('rootDir')){ function rootDir(){ return realpath($_SERVER["DOCUMENT_ROOT"])."\\"; } }
if(!function_exists('docRoot')){ function docRoot(){ return rootDir(); } }

if(!function_exists('randomKey'))
{
	function randomKey($length){
		$pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z')); for($key="",$i=0; $i < $length; $i++){ $key .= $pool[mt_rand(0, count($pool) - 1)]; }
		$key = str_replace("i","r",$key);
		$key = str_replace("I","R",$key);
		$key = str_replace("o","p",$key);
		$key = str_replace("O","P",$key);
		return $key;
	}
}

if(!function_exists('encodeurl'))
{
	function encodeurl($text){
		$text=urlencode($text); 
		$text=str_replace("+","%20",$text);
		return $text;
	}
}

if(!function_exists('valid_ip'))
{
	function valid_ip($ip){
		if(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/',$ip)) return true;
		return false;
	}
}

if(!function_exists('validAlphaNumeric'))
{
	function validAlphaNumeric($txt){
		if(preg_match('/[^a-zA-Z0-9]/i', $txt)) return false;
		return true;
	}
}

if(!function_exists('highlight'))
{
	function highlight($search,$str) {
		$highlightcolor = "yellow"; 
		$occurrences = substr_count(strtolower($str), strtolower($search));
		$newstring = $str;
		$match = array();
	
		for ($i=0;$i<$occurrences;$i++) {
			$match[$i] = stripos($str, $search, $i);
			$match[$i] = substr($str, $match[$i], strlen($search));
			$newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
		}
	
		$newstring = str_replace('[#]', '<span style="background-color: '.$highlightcolor.';">', $newstring);
		$newstring = str_replace('[@]', '</span>', $newstring);
		return $newstring;
	
	}
}

if (!function_exists('UserHistory'))
{
	function UserHistory($t=300)
	{
		if($_SESSION["sess"]["iduser"]>0 && $_SESSION["sess"]["iduser"]<999999999)
		{
			$t=DateBySecond($t,$op="-");
			$qry="SELECT * FROM sys_user_history 	WHERE 		userType				= '".$_SESSION["sess"]["base_profile"]."' 	AND
																iduser					= '".$_SESSION["sess"]["iduser"]."' 		AND
																domain					= '".domainNAME()."'				AND 
																SUBSTR(TimeStart,1,10)	= '".date("Y-m-d")."' 				AND 
																TimeEnd					> '".$t."' 
													ORDER BY 	TimeEnd DESC";
			$data=GetData($qry,"x");
			if(JumlahData($qry,"x")>0)
			{
				$TimeTotal=strtotime(date("Y-m-d H:i:s"))-strtotime($data["TimeStart"]??date("Y-m-d H:i:s")); if($TimeTotal==0) $TimeTotal=1;
				$qry="UPDATE sys_user_history SET TimeEnd='".date("Y-m-d H:i:s")."',TimeTotal='".$TimeTotal."' WHERE idhistory='".$data["idhistory"]."'";
				mysqli_query($_SESSION["sess"]["koneksi"],$qry);
			}
			else
			{
				$qry="INSERT INTO sys_user_history (userType,iduser,domain,TimeStart,TimeEnd) VALUES ('".$_SESSION["sess"]["base_profile"]."','".$_SESSION["sess"]["iduser"]."','".domainNAME()."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
				mysqli_query($_SESSION["sess"]["koneksi"],$qry);
			}
		}
	}
}

if (!function_exists('isJson'))
{
	function isJson($string)
	{
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}

if (!function_exists('ob_html_compress'))
{
	function ob_html_compress($buf)
	{
		/* $buf=str_replace(' ','_',$buf); */
		$buf=str_replace(array("\n","\r","\t"),'',$buf);
		for($i=2;$i<=100;$i++){ $buf=str_replace(str_repeat(" ",$i),'',$buf); }
		$buf=str_replace('> <','><',$buf);
		$buf=preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),$buf);
		$buf=str_replace("{nl}",PHP_EOL,$buf);

		/* $x ='<!DOCTYPE html><!-- ';
		$x.=str_repeat("\n",24);
		$x.=' ';
		$x.=str_repeat("\n",24);
		$x.='--><html';
		$buf=str_replace('<!DOCTYPE html><html',$x,$buf); */
		/* return str_repeat("\n",99).$buf; */
		
		return $buf;
	}
}

if (!function_exists('in_array_r')) // check in array multidimensional
{
	function in_array_r($needle, $haystack, $strict = false) 
	{
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
}


if (!function_exists('listFile'))
{
	function listFile($dir,$ext="...") 
	{
		$ignored = array('.', '..');

		$files = array();
		foreach (scandir($dir) as $file)
		{
			if(!isset($i)) $i=0;
			if (in_array($file, $ignored)) continue;

			$x=(strlen($ext)-(strlen($ext)*2))-1;
			if($ext!="...")
			{
				if(substr($file,$x)==".".$ext) $files[$i++] = $file;
			}
			else $files[$i++] = $file;
		}

		asort($files);
		return ($files) ? $files : false;
	}
}



if (!function_exists('excelColumnRange'))
{
	function excelColumnRange($lower, $upper) {
		++$upper;
		for ($i = $lower; $i !== $upper; ++$i) {
			yield $i;
		}
	}
}


if (!function_exists('wa2html'))
{
	function wa2html($s)
	{
		return preg_replace('/\*([^\*]*)\*/', '<strong>$1</strong>', preg_replace('/_([^_]*)_/', '<em>$1</em>', preg_replace('/~([^~]*)~/', '<del>$1</del>', $s)));
	}
}


if (!function_exists('html2wa'))
{
	function html2wa($s)
	{
		return preg_replace('/<\/?del>/', '~', preg_replace('/<\/?em>/', '_', preg_replace('/<\/?strong>/', '*', $s)));
	}
}



if (!function_exists('apiCurl'))
{
	function apiCurl($data)
	{
		/*
			$data["url"]        = "https://www.api.com/";
			$data["postFields"] = array();
			apiCurl($data);
		*/

		if(isset($data["url"]))
		{
			$ch = curl_init();     
			// curl_setopt($ch, CURLOPT_PROXY, $_SERVER['SERVER_ADDR'] . ':' .  $_SERVER['SERVER_PORT']);
			// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

			// curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", 'Content-Type: application/json' ));
			// curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_URL,$data["url"]);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			// if(isset($data["postFields"]))  array_push($data["postFields"],array("apikey"=>"bismillah123"));
			if(isset($data["postFields"]))  $data["postFields"]["apikey"]="bismillah123";
			else                            $data["postFields"]=array("apikey"=>"bismillah123");			
			
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data["postFields"]));// In real life you should use something like:			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Receive server response ...
			
			$headers = array("Origin: ".$_SESSION["sess"]["app_siteURL"], );
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			//for debug only!
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_VERBOSE, false);

			$server_output = curl_exec($ch);   // Check the return value of curl_exec(), too
			
			// $x["AAA"]=curl_getinfo($ch);
			$x["BBB"]=curl_error($ch);
			$x["CCC"]=curl_errno($ch);
            $checkSync["keyword"]   = "curl_getinfo";
            $checkSync["content"]   = is_array($x)?json_encode($x):$x;
            $checkSync              = SettingApp($checkSync);

			// array_push($_SESSION["sess"]["log"]["fcshm"],__LINE__.' : apiCurl() > '.json_encode($x));
			curl_close ($ch);

			return $server_output;
			// echo $server_output;
			// echo "<br>";
			// echo "<pre>";
			// print_r($postFields);
			// echo "</pre>";
		}
	
	}
}

if (!function_exists('FormatFileSize'))
{
	function FormatFileSize($bytes, $precision = 2) 
	{ 
		$units 	= array('B', 'KB', 'MB', 'GB', 'TB'); 
		$bytes 	= max($bytes, 0); 
		$pow 	= floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow 	= min($pow, count($units) - 1); 
		$bytes /= pow(1024, $pow); // $bytes /= (1 << (10 * $pow)); 
		$num 	= round($bytes, $precision);
		$prc 	= $num-floor($num)>0?$precision:0;

		return NumberFormat($num,$prc) . ' ' . $units[$pow]; 
	}
}

if (!function_exists('InputNomorUrut'))
{
	function InputNomorUrut($nmrInput="")
	{
		$NmrUnitQry = array();
		$cek1       = CleanNumeric($nmrInput);
		$cek2       = CleanAlphaNumeric($nmrInput);
		$nuType     = $cek1==$cek2?"numeric":"alphanumeric";    
		$nu         = explode(",",$nmrInput);
	
		for($i=0;$i<count($nu);$i++)
		{
			if(trim($nu[$i])!="")
			{
				$np = explode("-",$nu[$i]);
				if($nuType=="numeric")
				{
					if(CleanNumeric($np[0])!="")        $np1=CleanNumeric($np[0])-0;
					else 						        $np1=0;
					/*####*/
					if(count($np)==1)			        $np2=$np1;
					elseif(count($np)>=2){		
						if(CleanNumeric($np[1])!="") 	$np2=CleanNumeric($np[1])-0;
						else 					        $np2=0;
					}
			
					if($np1<=0 || $np2<=0 || $np2<$np1){ /* $nmrInput=""; $error=1; $status["nomor_perumahan"]="Nomor unit tidak relevan"; */ }
					elseif(count($np)==1)   array_push($NmrUnitQry,$np1);
					elseif(count($np)>=2)   for($npx=$np1;$npx<=$np2;$npx++) array_push($NmrUnitQry,$npx);
				}
				else
				{
					if(count($np)==1)                       array_push($NmrUnitQry,$np[0]);
					elseif(count($np)>=2)
					{
						if(CleanNumeric($np[0])!="")        $np1=CleanNumeric($np[0])-0;
						else 						        $np1=0;
						/*####*/
						if(count($np)==1)			        $np2=$np1;
						elseif(count($np)>=2){		
							if(CleanNumeric($np[1])!="") 	$np2=CleanNumeric($np[1])-0;
							else 					        $np2=0;
						}
			
						if($np1<=0 || $np2<=0 || $np2<$np1){}
						else for($npx=$np1;$npx<=$np2;$npx++) array_push($NmrUnitQry,$npx);
					}
				}
			}
		}

		return $NmrUnitQry;
	}
}

if (!function_exists('LabelDataWilayah'))
{
	function LabelDataWilayah($wilayah="",$opt=[])
	{
		$clearKota = $opt["clearKota"] ?? true;

		$wilayah = strtolower($wilayah);
		$wilayah = ucwords($wilayah);

		$wilayah = $clearKota==false ? $wilayah : str_replace("Kota Adm.","",$wilayah);
		$wilayah = $clearKota==false ? $wilayah : str_replace("Kab. Adm.","",$wilayah);
		$wilayah = $clearKota==false ? $wilayah : str_replace("Kota","",$wilayah);
		$wilayah = $clearKota==false ? $wilayah : str_replace("Kab.","",$wilayah);

		// $wilayah = str_replace("Adm.","Administrasi",$wilayah);
		// $wilayah = str_replace("Kep.","Kepulauan",$wilayah);
		$wilayah = str_replace("Dki","DKI",$wilayah);

		return trim($wilayah);
	}
}

if (!function_exists('lastDataArray'))
{
	function lastDataArray($arr)
	{	// data pertama multidimensional array
		$v=array(); $i=0;
		if(is_array($arr)){ foreach($arr AS $val){ $v[$i]=$val; $i++; }}

		return $v[($i-1)]??$v;
	}
}

if(!function_exists('isCloseToWhite')) {

	function isCloseToWhite($hexColor) {
		$hexColor = ltrim($hexColor, '#');
	
		$r = hexdec(substr($hexColor, 0, 2));
		$g = hexdec(substr($hexColor, 2, 2));
		$b = hexdec(substr($hexColor, 4, 2));
	
		$brightness = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);
	
		return $brightness > 230;
	}
}

if(!function_exists('sanitizeString')) {
	function sanitizeString($string, $id) {
		$string = preg_replace('/[^\w\s]/', '', $string); // removing special chars
		$string = preg_replace('/\s+/', '-', $string); // replacing one or more whitespaces with a hypen
		$string = strtolower($string); // making it lowercase
		
		$string = $string ."-". $id;
	
		return $string;
	}
}

if(!function_exists("isValidUtcOffsetFormat"))
{
	function isValidUtcOffsetFormat(string $offset): bool
	{
		// Pola Regex untuk memvalidasi format:
		// ^[+-]: Mulai dengan tanda + atau -
		// (0[0-9]|1[0-4]): Jam harus antara 00-14
		// : : Pemisah
		// (00|30|45): Menit harus 00, 30, atau 45 (zona waktu biasanya hanya menggunakan ini)
		// $ : Akhir string
		$pattern = '/^[+-](0[0-9]|1[0-4]):(00|30|45)$/';
		
		// Namun, jika Anda ingin mengizinkan SEMUA menit 00-59 (meski jarang digunakan)
		// $pattern = '/^[+-](0[0-9]|1[0-4]):([0-5][0-9])$/'; 

		return (bool) preg_match($pattern, $offset);
	}
}

if(!function_exists("setTglUTC"))
{
	function setTglUTC($datetime,$src_offset="+00:00",$dst_offset="+00:00")
	{
		if(isValidUtcOffsetFormat($src_offset) && isValidUtcOffsetFormat($dst_offset))
		{
			$src_offset_minute = (((int) substr($src_offset,1,2)) * 60) + ((int) substr($src_offset,4,2));
			$src_offset_minute = substr($src_offset,0,1)=="+" ? $src_offset_minute : ($src_offset_minute*-1);
			$dst_offset_minute = (((int) substr($dst_offset,1,2)) * 60) + ((int) substr($dst_offset,4,2));
			$dst_offset_minute = substr($dst_offset,0,1)=="+" ? $dst_offset_minute : ($dst_offset_minute*-1);

				if($src_offset_minute > $dst_offset_minute) 	{ $op="-"; $offset = (int) ($src_offset_minute-$dst_offset_minute); }
			elseif($src_offset_minute < $dst_offset_minute) 	{ $op="+"; $offset = (int) ($dst_offset_minute-$src_offset_minute); }
			else												{ $op="+"; $offset = (int) ($dst_offset_minute-$src_offset_minute); }
			
			$mp = $offset<0 ? ($offset*-1) : $offset; // Multiplier dipastikan bernilai positif
			$dt = DateBySecond(60*$mp,$op,$datetime);
		}
		else
		{
			$dt = $datetime;
		}

		return $dt;
	}
}

