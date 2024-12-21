<?php


class users_ajaxDashboardAddGroupPermissionsAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        $this->group=new Group($request->getPostParameter('group'));
        $this->user=new User($request->getPostParameter('user'));
        $this->permissions=groupPermissionUtils::getPermissionsGroupList($this->group);
    }

}