<?php

class userGuard_ajaxDashboardPermissionsViewPermissionAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->form = new permissionForm();
        $this->permission=new Permission($request->getPostParameter('id'));
    }

}
