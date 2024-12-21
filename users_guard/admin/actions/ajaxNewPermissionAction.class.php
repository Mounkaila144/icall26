<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionsNewForm.class.php";

class users_guard_ajaxNewPermissionAction extends mfAction {
  
     
     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
                      
        try 
        {
            $this->form = new PermissionsNewForm($request->getPostParameter('Permissions'),array());  
            if ($request->isMethod('POST') && $request->getPostParameter('Permissions'))
            {    
                $this->form->bind($request->getPostParameter('Permissions'));
                if ($this->form->isValid()) {
                    $this->permissionCollection = new PermissionCollection($this->form->getValue('collection'),'admin');
                    $this->permissionCollection->save();
                    $messages->addInfo(__("Permissions have been saved."));
                    $this->forward("users_guard","ajaxListPartialPermission");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));  
                }
            }
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }    
    }

}
