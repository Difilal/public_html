<?php

if(!isset($_POST["accessRights_idaccess"]) || !isset($_POST["accessRights_DefaultAccess"])) $status["respon"]="Access Forbidden";
else{

    $accessRights_idaccess      = $_POST["accessRights_idaccess"];
    $accessRights_DefaultAccess = $_POST["accessRights_DefaultAccess"];
    
    if(is_array($accessRights_DefaultAccess)){
            $count_default_access=count($accessRights_DefaultAccess);
            $accessRights_DefaultAccess=json_encode($accessRights_DefaultAccess);
    }
    else{
            $count_default_access="&nbsp;&nbsp;";
            $accessRights_DefaultAccess="";
    }
    
    $qry ="UPDATE sys_hak_akses_utama SET     default_access  ='".escStringDB($accessRights_DefaultAccess)."'
                                    WHERE   idaccess        ='".escStringDB($accessRights_idaccess)."'";
                    
    if(runQuery($qry)){
                        $status["respon"]="success";
                        $status["count_default_access"]=$count_default_access;
    }
    else                $status["respon"]="Response Failed[".__LINE__."]";

}

echo json_encode($status);