<?php

// key=[action]
return array(
    
    "ajaxChangeIsActiveUser"=>array('mode'=>'json'),     
    
    "ajaxEnableUser"=>array('mode'=>'json'),     
    
    "ajaxDisableUser"=>array('mode'=>'json'),
    
    "ajaxCheckEmail"=>array("mode"=>"json"),
    
    "ajaxSignin"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveAvatar"=>array("mode"=>"json","helpers"=>array("url"=>"")),
    
    "ajaxDeleteAvatar"=>array("mode"=>"json","helpers"=>array("url"=>"")),
    
    "ajaxDeleteMyAddress"=>array("mode"=>"json"),
    
    "loginForMobile"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed',  // mixed : smarty View/Cache  | file: fichier  | uri              
    ),
        
   
    
);