<?php

require_once dirname(__FILE__)."/../locales/Forms/UserProfileNewForm.class.php";

class users_ajaxNewProfileI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_profile_new'))))
           $this->forwardTo401Action();
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('users','ajaxListPartialProfile');  
        }       
        $this->form= new UserProfileNewForm((string)$form['lang']);
        $this->item_i18n=new UserProfileI18n(array('lang'=>(string)$form['lang']));        
    }

}
