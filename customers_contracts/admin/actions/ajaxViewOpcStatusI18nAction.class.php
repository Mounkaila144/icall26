<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractOpcStatusViewForm.class.php";
 
class customers_contracts_ajaxViewOpcStatusI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerContractOpcStatusViewForm();
        $this->item_i18n=new CustomerContractOpcStatusI18n($request->getPostParameter('CustomerContractOpcStatusI18n'));        
   }

}

