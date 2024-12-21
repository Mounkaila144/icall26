<?php


class users_guard_ajaxDashboardAddPermissionsGroupAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();      
        $this->group=new Group($request->getPostParameter('group'));
        //$this->group=$request->getRequestParameter('group', new Group($request->getPostParameter('group')));
        $this->permissions=groupPermissionUtils::getAllPermissions($this->group);
    }

}