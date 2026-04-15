<?php


$worker_wa_monitoring=worker_wa_monitoring();
if(is_array($worker_wa_monitoring)) echo json_encode($worker_wa_monitoring);
else                                echo $worker_wa_monitoring;