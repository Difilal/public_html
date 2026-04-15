<?php

$localHostingFolder  = "D:/irwan/!htdocs/!session_files/";
$AdmsFolder          = "D:/!session_files/";
$sharedHostingFolder = "/home/u1732518/!session_files@#&^@&*^@2ghg3g872HGUYWGE@8327&*@^#*&@^@2283289/";


if(file_exists($sharedHostingFolder))
{
    if( /* (date("H")==5  && date("i")==59 && date("s")>=55) || */ 
        (date("H")==11 && date("i")==59 && date("s")>=55) || 
        /* (date("H")==17 && date("i")>=59 && date("s")>=55) || */ 
        (date("H")==23 && date("i")==59 && date("s")>=45) )
    {
        $ignored=array('.', '..'); $dir=$sharedHostingFolder;
		foreach(scandir($dir) as $file)
		{
			if (in_array($file, $ignored)) continue;

			if(file_exists($dir.$file) && filetype($dir.$file)=="file") unlink($dir.$file);
			if(file_exists($dir.$file) && filetype($dir.$file)=="dir" )
            {
                foreach(scandir($dir.$file) as $file2)
                {
                    if(in_array($file2, $ignored)) continue;
                    if(file_exists($dir.$file."/".$file2)) unlink($dir.$file."/".$file2);
                }

                if(file_exists($dir.$file)) rmdir($dir.$file);
            }
		}
    }

    if(!file_exists($sharedHostingFolder."index.html")){ $myfile=fopen($sharedHostingFolder."index.html", "w") or die("Unable to open file!");fwrite($myfile,'<meta http-equiv="refresh" content="0;url=../" />');fclose($myfile); }
    $sharedHostingFolder.="7@m5-".md5(str_repeat(strrev(md5(date("Y-m-d"))).md5(date("Y-m-d")),4)).strrev(md5(str_repeat(strrev(md5(date("Y-m-d"))).md5(date("Y-m-d")),7)))."/";
    if(!file_exists($sharedHostingFolder)){ mkdir($sharedHostingFolder); $myfile=fopen($sharedHostingFolder."index.html", "w") or die("Unable to open file!");fwrite($myfile,'<meta http-equiv="refresh" content="0;url=../" />');fclose($myfile); }

    $sessionFolder=$sharedHostingFolder;
}
elseif(file_exists($sharedHostingFolder)) 	$sessionFolder=$sharedHostingFolder;
elseif(file_exists($AdmsFolder)) 			$sessionFolder=$AdmsFolder;
elseif(file_exists($localHostingFolder)) 	$sessionFolder=$localHostingFolder;

ini_set("session.gc_maxlifetime","86400"); // 21600 = 6 hours
if(isset($sessionFolder)) ini_set("session.save_path", $sessionFolder);


