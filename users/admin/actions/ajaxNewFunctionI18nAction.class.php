<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionNewForm.class.php";

class users_ajaxNewFunctionI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('users','ajaxListPartialStatus');  
        }       
        $this->form= new UserFunctionNewForm((string)$form['lang']);
        $this->user_function_i18n=new UserFunctionI18n(array('lang'=>(string)$form['lang']));        
    }

}
