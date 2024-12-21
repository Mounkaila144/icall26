<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractStatusNewForm.class.php";

class customers_contracts_ajaxNewStatusI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_contracts','ajaxListPartialStatus');  
        }       
        $this->form= new CustomerContractStatusNewForm((string)$form['lang'],array());
        $this->customer_contract_status_i18n=new CustomerContractStatusI18n(array('lang'=>(string)$form['lang']));        
    }

}
