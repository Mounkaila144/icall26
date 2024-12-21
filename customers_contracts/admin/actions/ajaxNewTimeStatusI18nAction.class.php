<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractTimeStatusNewForm.class.php";

class customers_contracts_ajaxNewTimeStatusI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_contracts','ajaxListPartialTimeStatus');  
        }       
        $this->form= new CustomerContractTimeStatusNewForm((string)$form['lang'],array());
        $this->item_i18n=new CustomerContractTimeStatusI18n(array('lang'=>(string)$form['lang']));        
    }

}
