<?php

if (!function_exists('UrlKey'))
{
	function UrlKey($tgl="")
	{	
        if($tgl=="") $tgl=date("Y-m-d");
        $qry="SELECT urlkey FROM data_urlshort WHERE tgl_dibuat LIKE '".$tgl."%' ORDER BY urlkey DESC";
        $mnr=cekdata($qry);
        if($mnr>0)  $UrlKey=$mnr+1;
        else        $UrlKey=1;

        $ThnArr = array(21=>"A",22=>"B",23=>"C",24=>"D",25=>"E",26=>"F",27=>"G",28=>"H",29=>"K",30=>"L",31=>"M");
        $blnArr = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>"A",11=>"B",12=>"C");
        $tglArr = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>"A",11=>"B",12=>"C",13=>"D",14=>"E",15=>"F",16=>"G",17=>"H",18=>"K",19=>"L",20=>"M",21=>"N",22=>"P",23=>"R",24=>"S",25=>"T",26=>"U",27=>"V",28=>"W",29=>"X",30=>"Y",31=>"Z");
        $NoUrut = $ThnArr[substr($tgl,2,2)].$blnArr[(substr($tgl,5,2)-0)].$tglArr[(substr($tgl,8,2)-0)];
        $NoUrut.= encode_TigaDigitAkhir_UrlKey($UrlKey);
        return strtolower($NoUrut);
	}
}



if (!function_exists('encode_TigaDigitAkhir_UrlKey'))
{
	function encode_TigaDigitAkhir_UrlKey($bil=0)
	{
        if($bil>10648 || $bil<1) $kode="000";
        else
        {
            $x=22;
            $c=$bil%$x;
    
            $b1=$bil-$c;
            $b2=$b1%($x*$x);
            $b3=$b2/$x;
            $b=$b3;
    
            $a1=$b1-$b2;
            $a2=$a1/($x*$x);
            $a=$a2;

            $abc=array("A","B","C","D","E","F","G","H","K","L","M","N","P","R","S","T","U","V","W","X","Y","Z");
    
            $kode ="";

            // $kode =$a;
            // $kode.=$b;
            // $kode.=$c;
            // $kode.="-";

            $kode.=$abc[$a];
            $kode.=$abc[$b];
            $kode.=$abc[$c];
        }
        return $kode;
    }
}

if (!function_exists('urlShort'))
{
	function urlShort($linkTarget="",$siteUrl="default")
	{
		if($linkTarget!="")
		{
			$qryLink="SELECT * FROM data_urlshort WHERE link_target='".escStringDB($linkTarget)."'";
			//$arrLink=getData($qryLink,"","all");
			if(cekData($qryLink)<1)
			{
                $UrlKey=UrlKey();
				$qryNewData="INSERT INTO data_urlshort SET	urlkey		= '".$UrlKey."',
															link_target	= '".escStringDB($linkTarget)."',
															tgl_dibuat	= '".date("Y-m-d H:i:s")."'";

                runQuery($qryNewData);
			}
			else
			{
				$qryData="SELECT urlkey FROM data_urlshort WHERE link_target ='".escStringDB($linkTarget)."'";
                $UrlKey=getData($qryData,"","urlkey");
			}
		}
        
        // $urlShort=$_SESSION["sess"]["http"]."://".$_SERVER['SERVER_NAME']."/".(isset($UrlKey)?$UrlKey:"");
        $siteUrl  = $siteUrl=="default"?$_SESSION["sess"]["app_siteURL"]:$siteUrl;
        $urlShort = $siteUrl.(isset($UrlKey)?$UrlKey:"");
        return $urlShort;
	}
}