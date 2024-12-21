<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeBillingModelNewForm.class.php";

class app_domoprime_ajaxNewBillingModelI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("Language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('app_domoprime_ajax','ajaxListPartialBillingModel');  
        }       
        $this->form= new DomoprimeBillingModelNewForm((string)$form['lang'],array());
        $this->item_i18n=new DomoprimeBillingModelI18n(array('lang'=>(string)$form['lang']));
        $this->country=$this->getUser()->getCountry();
    }

}
