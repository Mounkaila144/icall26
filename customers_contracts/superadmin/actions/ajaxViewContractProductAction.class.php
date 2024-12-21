<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractProductViewForm.class.php";



class customers_contracts_ajaxViewContractProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->item=new  CustomerContractProduct($request->getPostParameter('ContractProduct'),$this->site);     
        $this->form=new CustomerContractProductViewForm(array(),$this->site);        
    }

}
