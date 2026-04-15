<?php

header('Content-Type: application/javascript');

# matthiasmullie
use MatthiasMullie\Minify;

$minifier = new Minify\JS('js/index.js');
$dir="js/autoload/";
$jsf=listFile($dir,"js");
if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){ $minifier->add($dir.$filename); }

if($subdomain=="config")
{
    $obs=1;

    $dir="sub-config/js/js-global-auth/";
    $jsf=listFile($dir,"js");
    foreach ($jsf as $filename){ $minifier->add($dir.$filename); }


    if(isset($_SESSION["sess"]["vendorAdms"]))
    {
        // $dir="sub-config/page/sub-global-auth/".$_SESSION["sess"]["vendorAdms"]."/";
        // $filename=$_GET["subpg"].".js"; //echo $dir.$filename; exit;
        // $minifier->add($dir.$filename);
    }
    elseif($_SESSION["sess"]["iduser"]>0)
    {
        $dir="sub-config/js/js-signin-auth/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){  $minifier->add($dir.$filename);  }
    }
    elseif($_SESSION["sess"]["iduser"]==0)
    {
        $dir="sub-config/js/js-guest-auth/";
        $jsf=listFile($dir,"js");
        foreach ($jsf as $filename){ $minifier->add($dir.$filename); }
    }

    /* if($_SESSION["sess"]["subpg"]=="link-worker")
    {
        $minifier->add('sub-config/js/link-worker.js');
    }
    elseif($_SESSION["sess"]["role"]=="admin")
    {
        $minifier->add('sub-config/js/absensi-dashboard-script.js');
        $minifier->add('sub-config/js/absensi-dashboard-script-admin.js');
        $filename="sub-config/js/".$_SESSION["sess"]["subpg"].".js";
        if(file_exists($filename)){ $minifier->add($filename); }
    } 
    else
    {   
        $minifier->add('sub-config/js/login.js');
    }   */
}
elseif($subdomain=="app")
{
    $obs=1;

    $dir="sub-app/js/js-global-auth/";
    $jsf=listFile($dir,"js");
    if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){ $minifier->add($dir.$filename); }

    if($_SESSION["sess"]["iduser"]>0)
    {
        $dir="node_modules/@panzoom/panzoom/dist/";
        $filename="panzoom.min.js";
        $minifier->add($dir.$filename);

        /* $dir="node_modules/cropper/dist/";
        $filename="cropper.min.js";
        $minifier->add($dir.$filename); */

        /* $dir="node_modules/jquery-cropper/dist/";
        $filename="jquery-cropper.min.js";
        $minifier->add($dir.$filename); */

        /* $dir="node_modules/croppie/";
        $filename="croppie.js";
        $minifier->add($dir.$filename); */

        /* $dir="node_modules/crop-select-js/";
        $filename="crop-select-js.min.js";
        $minifier->add($dir.$filename); */

        $dir="sub-app/js/js-signin-auth/";
        $jsf=listFile($dir,"js");
        if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){  $minifier->add($dir.$filename);  }
    }
    elseif($_SESSION["sess"]["iduser"]==0)
    {
        $dir="sub-app/js/js-guest-auth/";
        $jsf=listFile($dir,"js");
        if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){ $minifier->add($dir.$filename); }
    }

}
elseif($subdomain=="keuangan")
{
    $obs=1;

    $dir="sub-keuangan/js/js-global-auth/";
    $jsf=listFile($dir,"js");
    if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){ $minifier->add($dir.$filename); }

    if($_SESSION["sess"]["iduser"]>0)
    {
        $dir="node_modules/@panzoom/panzoom/dist/";
        $filename="panzoom.min.js";
        $minifier->add($dir.$filename);

        /* $dir="node_modules/cropper/dist/";
        $filename="cropper.min.js";
        $minifier->add($dir.$filename); */

        /* $dir="node_modules/jquery-cropper/dist/";
        $filename="jquery-cropper.min.js";
        $minifier->add($dir.$filename); */

        /* $dir="node_modules/croppie/";
        $filename="croppie.js";
        $minifier->add($dir.$filename); */

        /* $dir="node_modules/crop-select-js/";
        $filename="crop-select-js.min.js";
        $minifier->add($dir.$filename); */

        $dir="sub-keuangan/js/js-signin-auth/";
        $jsf=listFile($dir,"js");
        if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){  $minifier->add($dir.$filename);  }
    }
    elseif($_SESSION["sess"]["iduser"]==0)
    {
        $dir="sub-keuangan/js/js-guest-auth/";
        $jsf=listFile($dir,"js");
        if(is_array($jsf) && count($jsf)>0) foreach ($jsf as $filename){ $minifier->add($dir.$filename); }
    }

}
else{ $obs=0; }


// or we can just add plain CSS
// $css = 'body { color: #000000; }';
// $minifier->add($css);

// save minified file to disk
// $minifiedPath = '/path/to/minified/css/file.css';
// $minifier->minify($minifiedPath);

// or just output the content
// $obs=11;
if($obs==1) $js=$minifier->minify();
else echo $minifier->minify();




if(isset($js))
{
    # tholu/php-packer
    //require 'vendor/tholu/php-packer/src/Packer.php';
    #$js = file_get_contents('sub-marketing/js/apps-script-operator.js');
    /*
    * params of the constructor :
    * $script:           the JavaScript to pack, string.
    * $encoding:         level of encoding, int or string :
    *                    0,10,62,95 or 'None', 'Numeric', 'Normal', 'High ASCII'.
    *                    default: 62 ('Normal').
    * $fastDecode:       include the fast decoder in the packed result, boolean.
    *                    default: true.
    * $specialChars:     if you have flagged your private and local variables
    *                    in the script, boolean.
    *                    default: false.
    * $removeSemicolons: whether to remove semicolons from the source script.
    *                    default: true.
    */
    // $packer = new Tholu\Packer\Packer($script,   $encoding,  $fastDecode, $specialChars, $removeSemicolons);
    $packer = new Tholu\Packer\Packer(  $js, 'None', true, false, true);
    $packed_js = $packer->pack();
    if($obs==1) echo $packed_js;
}