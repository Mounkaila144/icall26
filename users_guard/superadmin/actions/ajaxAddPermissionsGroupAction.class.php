<?php


class users_guard_ajaxAddPermissionsGroupAction  extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();     
       $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
       $this->group=new Group($request->getPostParameter('group'),'admin',$this->site);
       //$this->permissions=GroupPermissionUtils::getAllPermissions($this->group,$this->site);
       $this->group_permissions=GroupPermissionUtils::getAllPermissionsGroupByPermissionGroupForSuperadmin($this->group);               
    }

}