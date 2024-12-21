<?php


return array(
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header : header : only
    ),
   

    "ajaxBuildModuleManagerAdmin"=>array("mode"=>"json"),
        
    "ajaxChangeIsActiveModuleManager"=>array("mode"=>"json"),     
   
    "ajaxChangesIsActiveModuleManager"=>array("mode"=>"json"), 
          
    "ajaxChangeIsAvailableModuleManager"=>array("mode"=>"json"),  

    "ajaxRefreshModuleManagerAdmin"=>array("mode"=>"none"),  
   
    "ajaxBuildModuleManager"=>array("mode"=>"json"),  
    
    "ajaxIsActiveChangesModuleManager"=>array("mode"=>"json"),
               
    "ajaxIsAvailableChangesModuleManager"=>array("mode"=>"json"),      
                
    "ajaxDeletesModuleManager"=>array("mode"=>"json"),
    
    "ajaxInstallModuleManager"=>array("mode"=>"json"),
    
    "ajaxUninstallModuleManager"=>array("mode"=>"json"),
    
    "ajaxInstallModuleSitesModuleManagerAdmin"=>array("mode"=>"json"),
    
    "ajaxUninstallModuleSitesModuleManagerAdmin"=>array("mode"=>"json"),
    
    "ajaxUpdateSiteModuleManager"=>array("mode"=>"json"),
    
    "ajaxUpdateSiteFromSiteList"=>array("mode"=>"json","helpers"=>array("number"=>"")),
   // "ajaxSaveLoadModuleManagerAdmin"=>array("mode"=>"json"),
    "ajaxDeleteModuleManager"=>array("mode"=>"json"),
    
    "ajaxUpdateSites"=>array("mode"=>"json","helpers"=>array("number"=>"")),
    
);