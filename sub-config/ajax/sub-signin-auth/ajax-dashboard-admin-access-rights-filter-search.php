<?php sleep(0);

if(!isset($_POST["search_filename"])) exit;
$_SESSION["sess"]["AccessRights"]["filterModul_AccessRights"]       = $_POST["filterModul_AccessRights"];
$_SESSION["sess"]["AccessRights"]["filterFitur_AccessRights"]       = $_POST["filterFitur_AccessRights"];
$_SESSION["sess"]["AccessRights"]["filterPathdir_AccessRights"]     = $_POST["filterPathdir_AccessRights"];
$_SESSION["sess"]["AccessRights"]["search_filename"]                = trim($_POST["search_filename"]);
$_SESSION["sess"]["sessionPageNumber"]["PageNumber_AccessRights"]   = 1; // reset page number
//if($_SESSION["search_link"]!="") echo "1";

echo json_encode(array("respon"=>"success"));