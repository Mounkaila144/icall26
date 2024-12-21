<?php

// key=[action]
return array(
    /* ========================== servives ============================== */
    
    "ajaxCloseSiteTester"=>array('mode'=>'json'),   
    
    "List"=>array('mode'=>'json'),       
           
    "ServiceChangeAdmin"=>array('mode'=>'json'),
    
    "ServiceChangeFrontend"=>array('mode'=>'json'),
    
    "ServiceChangeGlobal"=>array('mode'=>'json'),      
    
    "ServicePing"=>array("mode"=>"json"),
    
    "SiteArchive"=>array('mode'=>'json'),
    
    "ajaxChangeAdmin"=>array('mode'=>'json'),
    
    "ajaxChangeFrontend"=>array('mode'=>'json'),       
    
    "ajaxChangeGlobal"=>array('mode'=>'json'),
    
    "ajaxSiteArchive"=>array('mode'=>'json'),
    
    "ajaxDeleteSiteServicesServer"=>array('mode'=>'json'),
    
    "ExportCsvSites"=>array("mode"=>"none","helpers"=>array('date'=>null,'number'=>null)),
    
    "ajaxDeleteSite"=>array('mode'=>'json'),
      
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
   
    

    

    
);