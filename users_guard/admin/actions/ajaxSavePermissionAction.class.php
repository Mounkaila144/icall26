<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionForm.class.php";

class users_guard_ajaxSavePermissionAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try 
        {
            $this->form = new PermissionForm();
            $this->permission=new Permission($request->getPostParameter('Permission'),'admin') ;
            $this->form->bind($request->getPostParameter('Permission'));
            if ($this->form->isValid() && $this->permission->isLoaded()) {
                $this->permission->add($this->form->getValues());
                if ($this->permission->isExist())
                   return $messages->addError(__("Permission already exists"));              
                $this->permission->save();
                $messages->addInfo(__("Permission [%s] has been saved.",$this->permission->get('name')));
                $this->forward('users_guard','ajaxListPartialPermission');
            }
            else
            {
                $messages->addError(__("Form has some errors."));
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }
}
  