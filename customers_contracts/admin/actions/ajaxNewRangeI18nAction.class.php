<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractRangeNewForm.class.php";

class customers_contracts_ajaxNewRangeI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_contracts','ajaxListPartialRange');  
        }       
        $this->form= new CustomerContractRangeNewForm((string)$form['lang'],array());
        $this->item_i18n=new CustomerContractRangeI18n(array('lang'=>(string)$form['lang']));        
    }

}
