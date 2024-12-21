<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAfterWorkModelNewForm.class.php";

class app_domoprime_ajaxNewAfterWorkModelI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("Language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime_ajax','ajaxListPartialAfterWorkModel');  
        }       
        $this->form= new DomoprimeAfterWorkModelNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimeAfterWorkModelI18n(array('lang'=>(string)$form['lang']));
        $this->country=$this->getUser()->getCountry();
    }

}
