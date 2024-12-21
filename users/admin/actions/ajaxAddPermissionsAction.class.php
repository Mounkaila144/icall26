<?php


class users_ajaxAddPermissionsAction  extends mfAction {
    
     
     function execute(mfWebRequest $request) 
     {   
        $messages = mfMessages::getInstance();          
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_permissions_user_add'))))
            $this->forwardTo401Action();        
        $this->user=new User($request->getPostParameter('User'),'admin');
        if (!$this->user->isAuthorized('permission_add'))
            $this->forwardTo401Action();  
        $this->permissions=userPermissionUtils::getAllPermissions($this->user);    
    }

}