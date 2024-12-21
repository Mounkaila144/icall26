<?php


require_once __DIR__."/../locales/Forms/DasboardMultipleRemovePermissionForm.class.php";

class users_guard_ajaxDashboardRemovePermissionAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();         
        $this->form_sites=new DasboardMultipleRemovePermissionSitesForm($this->getUser(),$request->getPostParameter('Sites'));
        $this->form_sites->bind($request->getPostParameter('Sites'));    
        if ($this->form_sites->isValid())
        {
            $this->form=new DasboardMultipleRemovePermissionForm($this->getUser(),$request->getPostParameter('Sites'));
           // var_dump($this->form->getSites());
        }          
    }

}

