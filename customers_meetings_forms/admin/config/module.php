<?php

// key=[action]
return array(
    
    "ajaxDeleteFormI18n"=>array("mode"=>"json"),
   
    "ajaxTest"=>array('mode'=>'none'),
    
    "ajaxChangeIsAdminForm"=>array("mode"=>"json"),
    
    "api2UpdateFormsForContract"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "api2GetFormsForContract"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "api2GetFormsForMeeting"=>array('mode'=>'json','helpers'=>array('url'=>null,'date'=>null,'number'=>null)),
    
    "api2UnHoldForms"=>array('mode'=>'json'),
    
    "api2HoldForms"=>array('mode'=>'json'),
        
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);