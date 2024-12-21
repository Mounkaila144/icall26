<?php

class customers_contracts_ajaxEmailContractAction extends mfAction {
    
               
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        $this->item=new CustomerContract($request->getPostParameter('Contract'));      
        $this->country=$this->getUser()->getCountry();
        if (!$this->item->getCustomer()->get('email'))
           $messages->addError(__("Email doesn't exist, you have to complete it."));
    }

}
