<?php

	if(!isset($_SESSION["sess"]["sessionPageNumber"][$PgNumSesID])) $_SESSION["sess"]["sessionPageNumber"][$PgNumSesID] = 1;
	$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID] = isset($_GET["page"]) ? $_GET["page"] : $_SESSION["sess"]["sessionPageNumber"][$PgNumSesID];
	$offset = ($_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]-1)*$dataPerPage;
	$showPage = isset($showPage) ? $showPage : '';

?>