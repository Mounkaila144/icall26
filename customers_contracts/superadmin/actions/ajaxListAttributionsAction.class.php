<?php

class customers_contracts_ajaxListAttributionsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                       
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site);                
    }

}
