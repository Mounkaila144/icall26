<?php


class customers_ajaxViewCustomerForContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    

    function execute(mfWebRequest $request) {              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site);        
        
        $this->customer=$this->contract->getCustomer();
   }

}

