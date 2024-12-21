<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionSuperAdminNewForm.class.php";

class users_guard_ajaxDashboardNewPermissionAction extends mfAction {
  

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        try {
            $this->form = new PermissionsSuperAdminNewForm($request->getPostParameter('permission')); // Repopulate in same time if error
            $this->form->bind($request->getPostParameter('permission'));
            if ($this->form->isValid()) {              
                $this->permissionCollection = new PermissionCollection($this->form->getValue('permissions'));
                $this->permissionCollection->save();
                $messages->addInfo(__("permissions have been saved."));
                $this->forward("users_guard","ajaxDashboardListPartialPermission");
            }
            else
            {             
                if ($request->getPostParameter('permission')!=null)
                {   
                    $messages->addErrors($this->form->getErrorSchema()->getGlobalErrors());
                }    
            }
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }       
    }

}
