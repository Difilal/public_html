<?php

function scan_dir($dir) 
{
    $ignored = array('.', '..', 'index.html');

    $files = array();    
    foreach (scandir($dir) as $file)
    {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}




$dir   = 'file-wa-notif-sync/';
$files = scan_dir($dir);

if(!is_array($files)) $files=array($files,"process"=>"stop");
echo json_encode($files);