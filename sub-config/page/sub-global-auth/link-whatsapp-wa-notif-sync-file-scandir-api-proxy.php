<?php

$dataCurl["url"]        = "https://config-tams.irwan.id/link-whatsapp-wa-notif-sync-file-scandir-api.async";
$dataCurl["postFields"] = array("act"=>"syncFile");
$dataApi                = apiCurl($dataCurl);

echo $dataApi;