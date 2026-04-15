<?php

$idangkatan=$_GET["idangkatan"];
recheckAbsensiKalender($idangkatan);    // melengkapi data kalender
echo date("Y-m-d H:i:s");