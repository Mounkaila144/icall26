<?php

require_once dirname(__FILE__)."/../locales/Forms/CreatePasswordUserForm.class.php";


class users_ajaxCreatePasswordUserAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();   
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_password_create'))))
            $this->forwardTo401Action();
        $this->user = new User($request->getPostParameter('User'),'admin'); // new object
        if (!$this->user->isAuthorized('view'))
             $this->forwardTo401Action();  
        $this->form = new CreatePasswordUserForm();               
    }

}
