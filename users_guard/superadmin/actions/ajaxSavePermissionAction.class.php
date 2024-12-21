<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionForm.class.php";

class users_guard_ajaxSavePermissionAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$this->site,"sites","ajaxAdmin"); 
        try 
        {
            $this->form = new PermissionForm(array(),$this->site);
            $this->permission=new Permission($request->getPostParameter('Permission'),'admin',$this->site);
            $this->form->bind($request->getPostParameter('Permission'));
            if ($this->form->isValid() && $this->permission->isLoaded()) {
                if ($this->permission->isExist())
                   return $messages->addError(__("Permission already exists")); 
                $this->permission->add($this->form->getValues());
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
  