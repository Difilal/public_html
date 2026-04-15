<?php

$idcabang=$_POST["idcabang"];
WaSenderBalancer($idcabang);          // meratakan beban antrian kirim
echo date("Y-m-d H:i:s");