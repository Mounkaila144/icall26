<?php

class customers_contracts_ajaxEmailContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';           
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                     
        $this->item=new CustomerContract($request->getPostParameter('Contract'),$this->site);      
        $this->country=$this->getUser()->getCountry();
        if (!$this->item->getCustomer()->get('email'))
           $messages->addError(__("Email doesn't exist, you have to complete it."));
    }

}
