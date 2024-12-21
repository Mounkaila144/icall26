<?php

require_once dirname(__FILE__)."/../locales/Forms/CreatePasswordUserForm.class.php";


class users_ajaxCreatePasswordUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
        $this->user = new User($request->getPostParameter('User'),'admin',$this->site); // new object
        $this->form = new CreatePasswordUserForm(array(),$this->site);               
    }

}
