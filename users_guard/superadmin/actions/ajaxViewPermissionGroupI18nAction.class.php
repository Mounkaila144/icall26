<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionsGroupViewForm.class.php";
 
class users_guard_ajaxViewPermissionGroupI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    
        
    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->form = new PermissionsGroupViewForm();
        $this->item=new PermissionGroupI18n($request->getPostParameter('PermissionGroupI18n'),$this->site);        
   }

}

