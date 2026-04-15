<?php

# matthiasmullie
use MatthiasMullie\Minify;

//$minifier = new Minify\CSS('css/bootstrap.min.css');
//$minifier->add('css/main.min.css');
$minifier = new Minify\CSS('css/main.min.css');
$minifier->add('css/style-default.css');
$minifier->add('css/style-custom.css');
$minifier->add('css/jquery-ui.css');
/* $minifier->add('text-security.css'); */


if($subdomain=="config")
{
    $subfilename="sub-config/css/".$_SESSION["sess"]["subpg"].".css";
    if(file_exists($subfilename)){ $minifier->add($subfilename); }
}
elseif($subdomain=="app")
{
    /* $dir="node_modules/cropper/dist/";
    $filename="cropper.min.css";
    $minifier->add($dir.$filename); */

    /* $dir="node_modules/croppie/";
    $filename="croppie.css";
    $minifier->add($dir.$filename); */

    /* $dir="css/";
    $filename="jquery.Jcrop.min.css";
    $minifier->add($dir.$filename); */

    /* $dir="node_modules/crop-select-js/";
    $filename="crop-select-js.min.css";
    $minifier->add($dir.$filename); */

    $subfilename="sub-app/css/".$_SESSION["sess"]["subpg"].".css";
    if(file_exists($subfilename)){ $minifier->add($subfilename); }
    
    /* $dir="sub-app/css/";
    $jsf=listFile($dir,"css");
    foreach ($jsf as $filename){ $minifier->add($dir.$filename); if(!file_exists($dir.$filename)) exit; } */
}
elseif($subdomain=="acc")
{
    /* $dir="node_modules/cropper/dist/";
    $filename="cropper.min.css";
    $minifier->add($dir.$filename); */

    /* $dir="node_modules/croppie/";
    $filename="croppie.css";
    $minifier->add($dir.$filename); */

    /* $dir="css/";
    $filename="jquery.Jcrop.min.css";
    $minifier->add($dir.$filename); */

    /* $dir="node_modules/crop-select-js/";
    $filename="crop-select-js.min.css";
    $minifier->add($dir.$filename); */

    $subfilename="sub-keuangan/css/".$_SESSION["sess"]["subpg"].".css";
    if(file_exists($subfilename)){ $minifier->add($subfilename); }
    
    /* $dir="sub-app/css/";
    $jsf=listFile($dir,"css");
    foreach ($jsf as $filename){ $minifier->add($dir.$filename); if(!file_exists($dir.$filename)) exit; } */
}
elseif($subdomain=="keuangan")
{
    /* $dir="node_modules/cropper/dist/";
    $filename="cropper.min.css";
    $minifier->add($dir.$filename); */

    /* $dir="node_modules/croppie/";
    $filename="croppie.css";
    $minifier->add($dir.$filename); */

    /* $dir="css/";
    $filename="jquery.Jcrop.min.css";
    $minifier->add($dir.$filename); */

    /* $dir="node_modules/crop-select-js/";
    $filename="crop-select-js.min.css";
    $minifier->add($dir.$filename); */

    $subfilename="sub-keuangan/css/".$_SESSION["sess"]["subpg"].".css";
    if(file_exists($subfilename)){ $minifier->add($subfilename); }
    
    /* $dir="sub-app/css/";
    $jsf=listFile($dir,"css");
    foreach ($jsf as $filename){ $minifier->add($dir.$filename); if(!file_exists($dir.$filename)) exit; } */
}
else{}

// or we can just add plain CSS
// $css = 'body { color: #000000; }';
// $minifier->add($css);

// save minified file to disk
$minifiedPath = 'css/autogen-'.$subdomain.'/style-'.$_SESSION["sess"]["subpg"].'.css';
/* $minifier->minify($minifiedPath); */
$minified = $minifier->minify();
file_put_contents($minifiedPath, $minified);

//sleep(1);
// or just output the content
// echo $minifier->minify();