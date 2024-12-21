<?php

// key=[action]
return array(
    
    "ajaxLogoutUser"=>array("mode"=>"json"),
    
    "ajaxRefreshConnectedUsers"=>array("mode"=>"json"),
    
    "ajaxCheckLogout"=>array("mode"=>"json"),
    
    "ajaxDeleteGroup"=>array("mode"=>"json"),
    
    "ajaxChangeUser"=>array("mode"=>"json"),
 
    "ajaxChangeUsers"=>array("mode"=>"json"),
    
    "ajaxChangeUserGroup"=>array("mode"=>"json"),
    
    "ajaxDeleteUser"=>array("mode"=>"json"),
    
    "ajaxDeletesUser"=>array("mode"=>"json"),
    
    "ajaxNewUserSave"=>array("mode"=>"json"),
    
    "ajaxUserSavePicture"=>array("mode"=>"json"),
    
    "ajaxDeletePictureUser"=>array("mode"=>"json"),
    
    "ajaxDeleteUserPermission"=>array("mode"=>"json"),
    
    "ajaxDeleteUserPermissions"=>array("mode"=>"json"),
    
    "ajaxRegeneratePassword"=>array("mode"=>"json"),        
    
    "ajaxNewUserCheckEmail"=>array("mode"=>"json"),
    
    "ajaxDeleteTeam"=>array("mode"=>"json"),
    
    "ajaxDeleteCallcenter"=>array("mode"=>"json"),
    
    "ajaxDisableUser"=>array("mode"=>"json"),
    
    "ajaxEnableUser"=>array("mode"=>"json"),
    
    "ajaxDeleteProfileI18n"=>array("mode"=>"json"),
    
    "ajaxUnlockUser"=>array("mode"=>"json"),
    
    "ajaxDeleteFunctionI18n"=>array("mode"=>"json"),
    
    "ajaxDeleteAttributionI18n"=>array("mode"=>"json"),
    
    "UploadImportProfile"=>array("mode"=>"json"),
    
 //   "ajaxProcessProfile"=>array("mode"=>"json"),
    
   /* ===================== API ============================== */
    
    "apiViewUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
       
    "apiListUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'number'=>null,'url'=>null)),
    
    "apiSaveUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiSaveNewUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),   
    
    "apiNewUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),   
    
    "apiChangeUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiDeleteUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiViewUserProfile"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiSaveUserProfile"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiViewProfile"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiNewUserProfile"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiSaveNewUserProfile"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiCreatePasswordUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiSaveCreatePasswordUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "apiGetUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "api2NewUser"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "api2ListTeamUser"=>array('mode'=>'json'),
    
    "api2GetUser"=>array('mode'=>'json'),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);