<?php

if(!isset($_POST["pathFile"])) exit;
//$_POST["pathFile"]="file-absensi/20210513/20210513_182821_000001001_AEWD202961478.jpg";

if(file_exists($_POST["pathFile"])) $status["respon"]="success";
else                                $status["respon"]="Path file not found";
echo json_encode($status);