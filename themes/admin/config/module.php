<?php

// key=[action] "moduleAction"= ....
return array(    
    
    
    "ajaxChangeIsActive"=>array("mode"=>"json"),
    
    "ajaxDelete"=>array("mode"=>"json"),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header
                    ),
    
    
);