<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeClassNewForm.class.php";

class app_domoprime_ajaxNewClassI18nAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime','ajaxListPartialClass');  
        }       
        $this->form= new DomoprimeClassNewForm($this->getUser(),(string)$form['lang']);
        $this->item_i18n=new DomoprimeClassI18n(array('lang'=>(string)$form['lang']));        
    }

}
