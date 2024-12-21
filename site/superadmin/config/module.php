<?php

// key=[action] "moduleAction"= ....
return array(
    
  //  "ajaxClearCache"=>array("mode"=>"json"),
    
    "ajaxChangeGlobal"=>array("mode"=>"json"),
    
    "ajaxChangeFrontend"=>array("mode"=>"json"),
    
    "ajaxChangeAdmin"=>array("mode"=>"json"),
    
 //   "ajaxChangeAccess"=>array("mode"=>"json"),
    
    "ajaxDeleteSite"=>array("mode"=>"json"),
    
    "ajaxClearCacheSuperAdmin"=>array("mode"=>"json"),
    
    "ajaxClearHostCache"=>array("mode"=>"json"),
    
    "ajaxClearAutoloadCache"=>array("mode"=>"json"),
    
    "ajaxClearDatabasesCache"=>array("mode"=>"json"),
    
    "ajaxSiteClearCacheAdmin"=>array("mode"=>"json"),
    
    "ajaxSiteClearCache"=>array("mode"=>"json"),
    
    "ajaxSiteClearCacheFrontend"=>array("mode"=>"json"),
    
    "ajaxClearCache"=>array("mode"=>"json"),
    
 //   "ajaxCleanUpForProduction"=>array("mode"=>"json"),
    
    "ajaxDeleteLog"=>array("mode"=>"json"),
    
    "ajaxCreateFreeSubDomain"=>array("mode"=>"json"),
    
    "ajaxRemoveDatabase"=>array("mode"=>"json"),    
    
    "ajaxDisableGlobalSites"=>array("mode"=>"json"),
    
    "ajaxChangeAccessFromList"=>array("mode"=>"json"),
    
    "ExportCsvSites"=>array("mode"=>"none","helpers"=>array('date'=>null,'number'=>null)),
    
    "ajaxGetSizeForSite"=>array("mode"=>"json","helpers"=>array('number'=>null)),
    
    "ajaxRemoveRecordSite"=>array("mode"=>"json","helpers"=>array('number'=>null)),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri  | header
                    ),
    
);