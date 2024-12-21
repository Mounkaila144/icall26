<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractTimeStatusViewForm.class.php";
 
class customers_contracts_ajaxViewTimeStatusI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerContractTimeStatusViewForm();
        $this->item_i18n=new CustomerContractTimeStatusI18n($request->getPostParameter('CustomerContractTimeStatusI18n'));        
   }

}

