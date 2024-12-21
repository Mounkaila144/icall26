<?php

require_once dirname(__FILE__)."/../locales/Forms/UserForm.class.php";

class users_ajaxViewUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();        
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->user=new User($request->getPostParameter('User'),'admin',$this->site);  
        $this->form = new UserForm($this->getUser(),array(),$this->site);         
    }

}
