<?php


class users_ajaxDashboardAddPermissionsAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();      
        $this->user=new User($request->getPostParameter('user'));
        $this->permissions=userPermissionUtils::getAllPermissions($this->user);     
    }

}