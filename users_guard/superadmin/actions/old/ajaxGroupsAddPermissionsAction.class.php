<?php


class userGuard_ajaxGroupsAddPermissionsAction  extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();     
       $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
       $this->forwardIf(!$site,"sites","ajaxAdmin");
       $this->group=new Group($request->getPostParameter('group'),'admin',$site);
       $this->permissions=groupPermissionUtils::getAllPermissions($this->group,$site);
    }

}