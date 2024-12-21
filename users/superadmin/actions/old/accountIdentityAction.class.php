<?php

class users_accountIdentityAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->form = new userAccountForm();
        $this->user=$this->context->getUser()->getGuardUser();    
    }

}
