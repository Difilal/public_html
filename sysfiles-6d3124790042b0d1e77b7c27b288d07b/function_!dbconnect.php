<?php

// ── Docker environment ────────────────────────────────────────────────────────
if(getenv('DOCKER_ENV') === 'true')
{
        ini_set("display_errors", 1);
        $_SESSION["sess"]["online"] = 1;

        $dbhost     = getenv('DB_HOST')       ?: 'db';
        $dbuser     = getenv('DB_USER_WEB')   ?: 'root';
        $dbpass     = getenv('DB_PASS_WEB')   ?: 'rootpassword';
        $dbname     = getenv('DB_NAME_WEB')   ?: 'pmpland_web';
        $mysql_port = (int)(getenv('DB_PORT') ?: 3306);

        $_SESSION["sess"]["condb"]["default"] = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $mysql_port);
        $_SESSION["sess"]["koneksi"]          = $_SESSION["sess"]["condb"]["default"];

        $dbhost  = getenv('DB_HOST')       ?: 'db';
        $dbuser  = getenv('DB_USER_APP')   ?: 'root';
        $dbpass  = getenv('DB_PASS_APP')   ?: 'rootpassword';
        $dbname  = getenv('DB_NAME_APP')   ?: 'pmpland_2022';
        $_SESSION["sess"]["condb"]["app"]     = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $mysql_port);
}
elseif(	$_SERVER['HTTP_HOST']=="pmpland.abc" 				||
		$_SERVER['HTTP_HOST']=="webdev.pmpland.abc"			||
		$_SERVER['HTTP_HOST']=="configweb.pmpland.abc" 		||
		$_SERVER['HTTP_HOST']=="configwebdev.pmpland.abc"	)
{       
		ini_set("display_errors",1);
		$_SESSION["sess"]["online"]=1;

		$dbhost		= "localhost";
		$dbuser		= "root";
		$dbpass		= "";
		$dbname		= "pmpland_web";
		$mysql_port = $_SERVER["SERVER_PORT"]==88 ? 3366 : 3306;

		$_SESSION["sess"]["condb"]["default"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);
		$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["default"];

		// $dbhost			= "localhost";
		// $dbuser			= "root";
		// $dbpass			= '';
		// $dbname			= "pmpland_2022";	
		// $mysql_port 	= 3306;
		// $_SESSION["sess"]["condb"]["app"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);
}
elseif(	$_SERVER['HTTP_HOST']=="pmpland.co.id" 				|| 
		$_SERVER['HTTP_HOST']=="configweb.pmpland.co.id"	|| 
		$_SERVER['HTTP_HOST']=="webdev.pmpland.co.id" 		|| 
		$_SERVER['HTTP_HOST']=="configwebdev.pmpland.co.id"	|| $_SERVER['HTTP_HOST']=="192.168.1.20")
{       	
		ini_set("display_errors",0);
		$_SESSION["sess"]["online"]=0;

		$dbhost		= "localhost";
		$dbuser		= "u916463115_pmpweb";
		$dbname		= "u916463115_pmpweb";
		$dbpass		= 'y8D&9qAh*fZit+~CG4';
		$mysql_port = $_SERVER["SERVER_PORT"]==88 ? 3366 : 3306;
		$_SESSION["sess"]["condb"]["default"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);
		$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["default"];

		// $dbhost		= "localhost";
		// $dbuser		= "u916463115_pmpdev";
		// $dbname		= "u916463115_pmpdev";
		// $dbpass		= 'aKl2Lmz5o&2RsZ8Cwcn=jtt?';
		// $_SESSION["sess"]["condb"]["app"] = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$mysql_port);

		$_SESSION["sess"]["env"]["dev"] = 1;
}
else
{
		echo "No database selected"; exit;
}