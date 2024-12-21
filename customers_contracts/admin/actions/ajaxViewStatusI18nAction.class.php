<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractStatusViewForm.class.php";
 
class customers_contracts_ajaxViewStatusI18nAction extends mfAction {
    
    
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerContractStatusViewForm();
        $this->item=new CustomerContractStatusI18n($request->getPostParameter('CustomerContractStatusI18n'));        
   }

}

