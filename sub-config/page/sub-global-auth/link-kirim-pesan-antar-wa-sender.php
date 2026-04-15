<?php

$idcabang=$_POST["idangkatan"];
WaSenderSelfNetCom($idcabang);        // saling kirim pesan antar wa sender
echo date("Y-m-d H:i:s");