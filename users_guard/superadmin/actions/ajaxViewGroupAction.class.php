<?php

require_once dirname(__FILE__)."/../locales/Forms/GroupForm.class.php";


class users_guard_ajaxViewGroupAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->form = new GroupForm();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$this->site,"sites","ajaxAdmin"); 
        $this->group=new Group($request->getPostParameter('id'),array('admin','frontend'),$this->site);
    }

}
