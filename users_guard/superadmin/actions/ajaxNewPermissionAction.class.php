<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionsNewForm.class.php";

class users_guard_ajaxNewPermissionAction extends mfAction {
  
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);              
        try 
        {
            $this->form = new PermissionsNewForm($request->getPostParameter('Permissions'),$this->site);              
            if ($request->isMethod('POST') && $request->getPostParameter('Permissions'))
            {    
                $this->form->bind($request->getPostParameter('Permissions'));
                if ($this->form->isValid()) {
                    $this->permissionCollection = new PermissionCollection($this->form->getValue('collection'),'admin',$this->site);
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
