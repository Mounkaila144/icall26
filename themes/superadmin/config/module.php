<?php

// key=[action]
return array(
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    "ajaxNewThemeAdminSave"=>array("mode"=>"json"),
    
    "ajaxDeleteTheme"=>array("mode"=>"json"),
    
    "ajaxDeleteThemes"=>array("mode"=>"json"),
    
    "ajaxDeletesThemes"=>array("mode"=>"json"),
    
    "ajaxDeletesTheme"=>array("mode"=>"json"),
    
    "ajaxChangeIsActiveTheme"=>array("mode"=>"json"),
    
);