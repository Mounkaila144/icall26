<?php

// key=[action]
return array(
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    "ajaxDeleteLanguages"=>array("mode"=>"json"),
    
    "ajaxChangeLanguages"=>array("mode"=>"json"),
    
    "ajaxDeleteLanguage"=>array("mode"=>"json"),
    
    "ajaxChangeLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardDeleteLanguages"=>array("mode"=>"json"),
    
    "ajaxDashboardDeleteLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardChangeLanguage"=>array("mode"=>"json"),
    
    "ajaxDashboardChangeLanguages"=>array("mode"=>"json"),
    
    "ajaxDashboardMoveLanguage"=>array("mode"=>"json"),
    
    "ajaxMoveLanguageAdmin"=>array("mode"=>"json"),
    
    "ajaxMoveLanguageFrontend"=>array("mode"=>"json"),
    
);