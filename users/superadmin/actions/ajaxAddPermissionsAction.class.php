<?php


class users_ajaxAddPermissionsAction  extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request) 
     {   
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);            
        $this->user=new User($request->getPostParameter('User'),'admin',$this->site);
        $this->permissions=UserPermissionUtils::getAllPermissionsForSuperadmin($this->user);    
    }

}