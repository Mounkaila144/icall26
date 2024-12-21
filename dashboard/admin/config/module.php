<?php

// key=[action]
return array(
    
    
    "Error401"=>array("always_access"=>true),
    
    "ajaxRemoveCacheTab"=>array("mode"=>"json"),
    
    "ajaxSaveSystemMenuI18n"=>array("mode"=>"json"),
    
    "ajaxMoveMenu"=>array("mode"=>"json"),
    
    "ajaxDeleteMenu"=>array("mode"=>"json"),
     
		
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed' , // mixed : smarty View/Cache  | file: fichier  | uri                   
               
                    ),
    
    
);