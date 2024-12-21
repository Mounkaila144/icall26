<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionsGroupNewForm.class.php";

class users_guard_ajaxNewPermissionGroupI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();         
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("Language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('users_guard','ajaxListPartialPermissionsGroup');  
        }       
        $this->form= new PermissionsGroupNewForm((string)$form['lang'],array());
        $this->item=new PermissionGroupI18n(array('lang'=>(string)$form['lang']));        
    }

}
