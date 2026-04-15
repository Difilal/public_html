<?php 

cronjobServerWA_syncAbsensiPhoto(); 

function scan_dirx($dir) 
{
    $ignored = array('.', '..');

    $files = array();    
    foreach (scandir($dir) as $file)
    {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    // $files = array_keys($files);
    $files = $files;

    return ($files) ? $files : false;
}


$dir='D:/irwan/!htdocs/wa-api-3/uploads/';
if(file_exists($dir) && date("H")==23 && date("i")>=55)
{
    $files = scan_dirx($dir);
    // print_r($files);

    foreach($files AS $k=>$v)
    {
        // echo $k.":".$v;
        if($v<strtotime(DateBySecond(60*60*24*10,"-"))) 
        unlink($dir.$k);
    }
}
