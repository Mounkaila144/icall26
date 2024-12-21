<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractRangeViewForm.class.php";
 
class customers_contracts_ajaxViewRangeI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerContractRangeViewForm();
        $this->item=new CustomerContractRangeI18n($request->getPostParameter('CustomerContractRangeI18n'));        
   }

}

