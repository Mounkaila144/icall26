<?php

// key=[action]
return array(
    
    "callbackUser"=>array("always_access"=>true),
    
    "callbackError"=>array("always_access"=>true),
    
    "ajaxUploadConfig"=>array('mode'=>'json'),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed' , // mixed : smarty View/Cache  | file: fichier  | uri                   
               
                    ),
    
    
);