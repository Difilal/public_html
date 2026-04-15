<?php

//error handler function
function customError($errno, $errstr) {
    $_SESSION["sess"]["eyoy"] = "<b>Error:</b> [$errno] $errstr";
  }
  
  //set error handler
  set_error_handler("customError");
  
  //trigger error

$fileName     	= $_POST["fileName"]??"";
$urlFilePath	= $_POST["urlFilePath"]??""; //$urlFilePath=str_replace("https://","http://",$urlFilePath);
$pathFolder		= "D:/xampp_htdocs/pmpland_2022/file-wa-notif-sync/";

if(copy($urlFilePath,$pathFolder.$fileName))
{

    // $myfile = fopen(FilterAlphaNumeric($fileName).".txt", "w") or die("Unable to open file!");
    // $txt    = '$fileName : '.$fileName.PHP_EOL;
    // $txt   .= '$urlFilePath : '.$urlFilePath.PHP_EOL;
    // $txt   .= '$pathFolder : '.$pathFolder;
    // $txt   .= isset($_SESSION["sess"]["eyoy"])?'$_SESSION["sess"]["eyoy"]:'.$_SESSION["sess"]["eyoy"]:"";

    // fwrite($myfile, $txt);
    // fclose($myfile);
}
else
{

    // $myfile = fopen("!aaaaaaaaaaaa.txt", "w") or die("Unable to open file!");
    // $txt    = '$fileName : '.$fileName.PHP_EOL;
    // $txt   .= '$urlFilePath : '.$urlFilePath.PHP_EOL;
    // $txt   .= '$pathFolder : '.$pathFolder;
    // $txt   .= isset($_SESSION["sess"]["eyoy"])?'$_SESSION["sess"]["eyoy"]:'.$_SESSION["sess"]["eyoy"]:"";

    // fwrite($myfile, $txt);
    // fclose($myfile);
}