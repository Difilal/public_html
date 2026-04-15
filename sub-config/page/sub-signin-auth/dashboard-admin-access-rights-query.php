<?php 

if(!isset($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]))		$_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]="";
if(!isset($_SESSION["sess"]["AccessRights"]["filterFitur_AccessRights"]))		$_SESSION["sess"]["AccessRights"]["filterFitur_AccessRights"]="";
if(!isset($_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"]))		$_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"]="";
if(!isset($_SESSION["sess"]["AccessRights"]["search_filename"]))				$_SESSION["sess"]["AccessRights"]["search_filename"]="";

$qryWhere		= "";
$search_qry		= $qryWhere;
$qry_total_data	= "SELECT hku.*, hkm.*, hku.idmodul AS hku_idmodul FROM sys_hak_akses_utama hku LEFT JOIN sys_hak_akses_modul hkm ON hku.idmodul=hkm.idmodul";

if(isset($_SESSION["sess"]["AccessRights"]["search_filename"]) && $_SESSION["sess"]["AccessRights"]["search_filename"]!="")
{
	$t=$_SESSION["sess"]["AccessRights"]["search_filename"];
	if(strlen($t)==10)    $formatTgl=substr($t,6,4)."-".substr($t,3,2)."-".substr($t,0,2);
	elseif(strlen($t)==7) $formatTgl=substr($t,3,4)."-".substr($t,0,2);
	elseif(strlen($t)==5) $formatTgl=substr($t,3,2)."-".substr($t,0,2);
	elseif(strlen($t)==4) $formatTgl=substr($t,0,4);
	else                  $formatTgl=$t;

	$search_qry.="(";
	$search_qry.="hku.filename LIKE '%".escStringDB($_SESSION["sess"]["AccessRights"]["search_filename"])."%' OR ";
	$search_qry.="hkm.nama_modul LIKE '%".escStringDB($_SESSION["sess"]["AccessRights"]["search_filename"])."%' OR ";
	$search_qry.="hkm.sub_modul LIKE '%".escStringDB($_SESSION["sess"]["AccessRights"]["search_filename"])."%'";
	$search_qry.=")";
}

if($_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"]!="")
{
	if($search_qry!="") $search_qry.=" AND ";
	$search_qry.="hku.pathdir='".escStringDB($_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"])."'";
}


if($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]=="isset")
{
	if($search_qry!="") $search_qry.=" AND ";
	$search_qry.="hku.idmodul>0";
}
elseif($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]=="unset")
{
	if($search_qry!="") $search_qry.=" AND ";
	$search_qry.="(hku.idmodul=0 || hku.idmodul IS NULL)";
}
elseif($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]=="nonmodul")
{
	if($search_qry!="") $search_qry.=" AND ";
	$search_qry.="hku.idmodul<0";
}
elseif($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]!="")
{
	if($search_qry!="") $search_qry.=" AND ";
	$search_qry.="hkm.nama_modul='".escStringDB($_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"])."'";
}


if($_SESSION["sess"]["AccessRights"]["filterFitur_AccessRights"]!="")
{
	if($search_qry!="") $search_qry.=" AND ";
	$search_qry.="hkm.sub_modul='".escStringDB($_SESSION["sess"]["AccessRights"]["filterFitur_AccessRights"])."'";
}


if($search_qry!="") $qry_total_data.=" WHERE ".$search_qry;
$_SESSION["sess"]["AccessRights"]["query"]=$qry_total_data;

$PgNumSesID		= "PageNumber_AccessRights"; /*Session ID Page Number*/
$PrefixurlPgNum	= "dashboard-admin-access-rights"; /*Prefix Url Page Number Link*/
$classPgNumA	= 'class="c-pagination__control"'; /* Style Button General */
$classPgNumB	= 'class="btn btn-primary"'; /* Style Button Selected */
$AllDataQry		= $qry_total_data; /*Query Semua Data di tabel*/
$dataPerPage 	= 50;
include("sysfiles-".md5("sysfiles")."/"."page-number-top.php");

# hitung total data
$total_data=mysqli_num_rows(mysqli_query($_SESSION["sess"]["koneksi"],$qry_total_data)); 
#echo $qry_total_data; exit;

$qry_total_data.=" ORDER BY hku.pathdir ASC, hku.filename ASC"." LIMIT $offset, $dataPerPage";