<?php 

$monitoring_outboxwa_notif=monitoring_outboxwa_notif();
if(is_array($monitoring_outboxwa_notif)) echo json_encode($monitoring_outboxwa_notif);