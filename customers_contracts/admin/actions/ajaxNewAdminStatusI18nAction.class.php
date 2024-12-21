<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractAdminStatusNewForm.class.php";

class customers_contracts_ajaxNewAdminStatusI18nAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();            
        $form=new LanguageFrontendForm($this->getUser()->getCountry());
        $form->bind($request->getPostParameter('lang'));
        if (!$form->isValid())
        {
            $messages->addError(__("language is not valid."));
            $request->addRequestParameter('lang',$this->getUser()->getCountry());
            $this->forward('customers_contracts','ajaxListPartialAdminStatus');  
        }       
        $this->form= new CustomerContractAdminStatusNewForm((string)$form['lang'],array());
        $this->item_i18n=new CustomerContractAdminStatusI18n(array('lang'=>(string)$form['lang']));        
    }

}
