<?php

// key=[action]
return array(
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    "ajaxSettingsDelete"=>array("mode"=>"json"),
    
    "callbackUser"=>array('always_access'=>true),
    
    "callbackError"=>array('always_access'=>true),
);