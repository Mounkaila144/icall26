<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionForm.class.php";

class users_guard_ajaxViewPermissionAction extends mfAction {
    
     
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
                
          
        $this->form = new PermissionForm();
        $this->permission=new Permission($request->getPostParameter('id'),'admin') ;
    }

}
