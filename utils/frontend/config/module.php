<?php

// key=[action] "moduleAction"= ....
return array(
    "ajaxCity"=>array("mode"=>"json","always_access"=>true),
    
    "getJavascriptController"=>array(
        "always_access"=>true,
        "cacheEnabled"=>true,
    ),

    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header
                    ),
    
    
);