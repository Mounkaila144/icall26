<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionForm.class.php";

class users_guard_ajaxViewPermissionAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$this->site,"sites","ajaxAdmin");  
        $this->form = new PermissionForm();
        $this->permission=new Permission($request->getPostParameter('id'),array('admin','frontend'),$this->site);
    }

}
