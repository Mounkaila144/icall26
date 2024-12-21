<?php

require_once dirname(__FILE__)."/../locales/Forms/UserSuperAdminForm.class.php";

class users_ajaxDashboardViewUserAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->form = new UserSuperAdminForm();
        $this->user=new User($request->getPostParameter('id'));    
        $this->current_user=$this->getUser();           
    }

}
