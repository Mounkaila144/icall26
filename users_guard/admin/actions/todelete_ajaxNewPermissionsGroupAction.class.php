<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionsGroupNewForm.class.php";

class users_guard_ajaxNewPermissionsGroupAction extends mfAction {
  
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);              
        try 
        {
            $this->form = new PermissionsGroupNewForm($request->getPostParameter('PermissionsGroup'),array(),$this->site);  
            if ($request->isMethod('POST') && $request->getPostParameter('PermissionsGroup'))
            {    
                $this->form->bind($request->getPostParameter('PermissionsGroup'));
                if ($this->form->isValid()) {
                    $this->collection = new PermissionGroupCollection($this->form->getValue('collection'),$this->site);
                    $this->collection->save();
                    $messages->addInfo(__("Groups have been saved."));
                    $this->forward("users_guard","ajaxListPartialPermissionsGroup");
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
