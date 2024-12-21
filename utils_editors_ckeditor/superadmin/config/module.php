<?php

// key=[action] "moduleAction"= ....
return array(
    
     "getJavascriptController"=>array(
                 "cacheEnabled"=>true,
    ),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header
                    ),
    
    
);