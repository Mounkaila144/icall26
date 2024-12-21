<?php

// key=[action]
return array(
    
    "ServiceLogin"=>array('mode'=>'json',"always_access"=>true),
    
    "ServiceListSites"=>array('mode'=>'json'),
    
    "ServicePing"=>array('mode'=>'json'),
    
    "ServiceChangeAdminSites"=>array('mode'=>'json'),
    
    "ajaxPingServer"=>array('mode'=>'json'),
    
    "ajaxRefreshServer"=>array('mode'=>'json'),
    
     "ServiceExists"=>array('mode'=>'json'),
    
   // "ServiceCreateSite"=>array('mode'=>'json'),
    
    "ServiceDatabaseExists"=>array('mode'=>'json'),
    
    "ajaxPing"=>array('mode'=>'json'),
    
    "ServiceMasterPing"=>array('mode'=>'json',"always_access"=>true),
    
    "ServiceCreateServer"=>array('mode'=>'json'),
    
    "ServiceServiceSiteList"=>array('mode'=>'json'),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),

);