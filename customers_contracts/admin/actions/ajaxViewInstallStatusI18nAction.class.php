<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractInstallStatusViewForm.class.php";
 
class customers_contracts_ajaxViewInstallStatusI18nAction extends mfAction {
    
  
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerContractInstallStatusViewForm();
        $this->item_i18n=new CustomerContractInstallStatusI18n($request->getPostParameter('CustomerContractInstallStatusI18n'));        
   }

}

