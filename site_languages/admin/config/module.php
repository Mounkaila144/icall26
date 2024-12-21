<?php

return array(
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),        
    
    "ajaxDashboardChangeLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardDeleteLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardDeletesLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardChangesLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardMoveLanguage"=>array("mode"=>"json"),
    
    "ajaxChangeLanguage"=>array("mode"=>"json"),
    
    "ajaxDeletesLanguage"=>array("mode"=>"json"),
    
    "ajaxDeleteLanguage"=>array("mode"=>"json"),
    
);