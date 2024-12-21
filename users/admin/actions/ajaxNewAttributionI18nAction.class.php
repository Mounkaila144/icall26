<?php

require_once dirname(__FILE__)."/../locales/Forms/UserAttributionNewForm.class.php";

class users_ajaxNewAttributionI18nAction extends mfAction {
    
        
    
        
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
        $this->form= new UserAttributionNewForm((string)$form['lang']);
        $this->item=new UserAttributionI18n(array('lang'=>(string)$form['lang']));        
    }

}
