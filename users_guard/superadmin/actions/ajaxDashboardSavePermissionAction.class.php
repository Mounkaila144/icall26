<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionForm.class.php";

class users_guard_ajaxDashboardSavePermissionAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try {
            $this->form = new PermissionForm();
            $this->permission=new Permission($request->getPostParameter('permission'));
            $this->form->bind($request->getPostParameter('permission'));
            if ($this->form->isValid()) {
                if ($this->permission->isExist())
                   return $messages->addError(__("permission already exists")); 
                $this->permission->add($this->form->getValues());
                $this->permission->save();
                $messages->addInfo(__("permission has been saved."));
                $this->forward('users_guard','ajaxDashboardListPartialPermission');
            }
            else
            {
                $messages->addErrors($this->form->getErrorSchema()->getGlobalErrors());
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }
}
  