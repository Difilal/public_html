<?php

$idaccess=$_POST["idaccess"]??-1;
$qry="DELETE FROM sys_hak_akses_utama WHERE idaccess='".escStringDB($idaccess)."'";

if(runQuery($qry))  echo "success";
else                echo "failed";