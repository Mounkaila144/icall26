<?php

// key=[action] "moduleAction"= ....
return array(
       
     "ajaxSiteClearCacheAdmin"=>array("mode"=>"json"),
    
    "ajaxSiteClearCache"=>array("mode"=>"json"),
    
    "ajaxSiteClearCacheFrontend"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header
                    ),
    
);