<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractAdminStatusViewForm.class.php";
 
class customers_contracts_ajaxViewAdminStatusI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerContractAdminStatusViewForm();
        $this->item_i18n=new CustomerContractAdminStatusI18n($request->getPostParameter('CustomerContractAdminStatusI18n'));        
   }

}

