<?php

// key=[action] "moduleAction"= ....
return array(
    
    "ajaxDeleteSites"=>array("mode"=>"json"),
    
    "ajaxChangeGlobal"=>array("mode"=>"json"),
    
    "ajaxChangeAdminSites"=>array("mode"=>"json"),
    
    "ajaxDisableGlobalSites"=>array("mode"=>"json"),
    
    "ajaxChangeFrontendSites"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header : header : only
                    ),
    
    
);