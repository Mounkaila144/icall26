<?php


class users_guard_ajaxAddPermissionsGroupAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();           
       if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_permissions_add'))))
            $this->forwardTo401Action ();
       $this->group=new Group($request->getPostParameter('group'),'admin');
      // $this->permissions=GroupPermissionUtils::getAllPermissions($this->group);
       $this->group_permissions=GroupPermissionUtils::getAllPermissionsGroupByPermissionGroup($this->group);       
    }

}