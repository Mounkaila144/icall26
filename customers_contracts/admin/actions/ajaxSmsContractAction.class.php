<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_contracts_ajaxSmsContractAction extends mfAction {
    
        
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                           
        $this->item=new CustomerContract($request->getPostParameter('Contract'));    
        if (!$this->item->getCustomer()->get('mobile'))
           $messages->addWarning(__("Mobile doesn't exist, you have to complete it."));
    }

}
