<?php

// key=[action]
return array(

    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
       
      "ajaxChangeUser"=>array("mode"=>"json"),
 
      "ajaxChangeUsers"=>array("mode"=>"json"),
          
      "ajaxRegeneratePassword"=>array("mode"=>"json"),
    
 //   "ajaxAddPermissionsSave"=>array("mode"=>"none"),
    
 //   "ajaxAccountIdentityDeletePicture"=>array("mode"=>"json"),
         
    
      "ajaxNewUserSave"=>array("mode"=>"json"),
    
 //   "ajaxUserSavePicture"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
 //   "ajaxDeletePictureUser"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
      "ajaxDeleteUsers"=>array("mode"=>"json"),
    
       "ajaxDeleteUser"=>array("mode"=>"json"),
    
  //  "ajaxChangeUsers"=>array("mode"=>"json"),
    
    "ajaxDeleteUserPermission"=>array("mode"=>"json"),
    
    "ajaxDeleteUserPermissions"=>array("mode"=>"json"),
    
    "ajaxChangeUserGroup"=>array("mode"=>"json"),
    
    "ajaxAddGroupsSave"=>array("mode"=>"none"),
    
    "ajaxDeleteGroup"=>array("mode"=>"json"),
    
 //   "ajaxDeleteGroups"=>array("mode"=>"json"),
    
    
    "ajaxDashboardChangeUser"=>array("mode"=>"json"),
    
 //   "ajaxDashboardDeleteUsers"=>array("mode"=>"json"),
    
 //   "ajaxDashboardAddGroupsSave"=>array("mode"=>"none"),    
        
    "ajaxDashboardDeleteGroup"=>array("mode"=>"json"),
    
 //   "ajaxDashboardDeleteGroups"=>array("mode"=>"json"),
    
    "ajaxDashboardChangeUserGroup"=>array("mode"=>"json"),
    
 //   "ajaxDashboardChangeUserGroups"=>array("mode"=>"json"),
    
 //   "ajaxDashboardAddPermissionsSave"=>array("mode"=>"none"),
    
 //   "ajaxDashboardDeleteUserPermission"=>array("mode"=>"json"),       
    
//    "ajaxDashboardDeleteUsersGroupsPermissions"=>array("mode"=>"json"),     
    
 //   "ajaxAccountIdentitySavePicture"=>array("mode"=>"json"),
    
 //   "ajaxDashboardDeleteUserPermissions"=>array("mode"=>"json"),
    
    "ajaxDashboardDeleteUser"=>array("mode"=>"json"),
    
    "ajaxDashboardNewUserSave"=>array("mode"=>"json"),

 //   "ajaxDashboardUserSavePicture"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
 //   "ajaxDashboardDeletePictureUser"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
 //   "ajaxDashboardChangeUsers"=>array("mode"=>"json"),
    
 //   "ajaxDashboardDeletesUser"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
      "ajaxDashboardRegeneratePasswordUser"=>array("mode"=>"json"),
    
      "ajaxDeleteFunctionI18n"=>array("mode"=>"json"),
    
      "ajaxDeleteTeam"=>array("mode"=>"json"),
    
      "ajaxDeleteAttributionI18n"=>array("mode"=>"json"),
    
      "ajaxNewUserCheckEmail"=>array("mode"=>"json"),
    
      "ajaxRemoveDuplicateTeamUser"=>array("mode"=>"json"),
    
     "ajaxUnlockUser"=>array("mode"=>"json"),
    
    "ajaxUnlockUserForSite"=>array("mode"=>"json"),
);