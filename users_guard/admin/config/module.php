<?php

// key=[action]
return array(
    
  //  "ajaxDashboardGroupsAddPermissionsSave"=>array("mode"=>"none"),
    
  //  "ajaxGroupsAddPermissionsSave"=>array("mode"=>"none"),
    
 //   "ajaxGroupsDeletePermission"=>array("mode"=>"json"),
    
 //   "ajaxGroupsDeletePermissions"=>array("mode"=>"json"),      
    
 //   "ajaxDashboardPermissionsDeletePermissions"=>array("mode"=>"json"),
    
 //   "ajaxDashboardGroupsChangeGroups"=>array("mode"=>"json"),
    
 //   "ajaxDashboardGroupsDeleteGroups"=>array("mode"=>"json"),
    
 //   "ajaxDashboardGroupsDeletePermission"=>array("mode"=>"json"),
    
 //   "ajaxDashboardGroupsDeletePermissions"=>array("mode"=>"json"),
    
 //   "ajaxDashboardGroupsChangeGroup"=>array("mode"=>"json"),
    
 //   "ajaxDashboardGroupsDeleteGroup"=>array("mode"=>"json"),
    
     "ajaxDeletePermission"=>array("mode"=>"json"),
    
     "ajaxDeletesPermission"=>array("mode"=>"json"),
    
     "ajaxDeletePermissionGroup"=>array("mode"=>"json"),
 //   "ajaxGroupsDeleteGroups"=>array("mode"=>"json"),
    
 //   "ajaxGroupsChangeGroups"=>array("mode"=>"json"),
    
    "ajaxDeleteGroup"=>array("mode"=>"json"),
    
    "ajaxChangeGroup"=>array("mode"=>"json"),
    
  //  "ajaxDashboardDeletePermission"=>array("mode"=>"json"),
    
 //   "restrictiveAccessFile"=>array("mode"=>"none"),
    
//    "ajaxDashboardPermissionsDeletePermission"=>array("mode"=>"json"),
    
//     "ajaxDeletePermissionsGroups"=>array("mode"=>"json"),
    
     "ajaxDeletePermissionGroupI18n"=>array("mode"=>"json"),
    
    "ajaxCopyGroup"=>array('mode'=>'json'),
    
    "ExportCsvSessions"=>array("mode"=>"none","helpers"=>array('date'=>null,'number'=>null)),    
    
 //   "ajaxMultipleProcessSelection"=>array("mode"=>"json"),
    
    //"signinByCode"=>array('always_access'=>true),
    
    "authentificationByCode"=>array('always_access'=>true),
    
    "ajaxDeletesGroup"=>array('mode'=>'json'),
    
    "ajaxChangeGroups"=>array('mode'=>'json'),
    

    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);