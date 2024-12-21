<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_contracts_ajaxSmsContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                  
        $this->item=new CustomerContract($request->getPostParameter('Contract'),$this->site);     
         if (!$this->item->getCustomer()->get('mobile'))
           $messages->addWarning(__("Mobile doesn't exist, you have to complete it."));
    }

}
