<?php

$dataCurl["url"]        = "https://config-tams.irwan.id/link-whatsapp-wa-notif-sync-file-remove-api.async";
$dataCurl["postFields"] = array("copiedFiles"=>$_POST["copiedFiles"]);
$dataApi                = apiCurl($dataCurl);

echo $dataApi;