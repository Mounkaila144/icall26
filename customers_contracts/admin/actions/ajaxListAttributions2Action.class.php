<?php

class customers_contracts_ajaxListAttributions2Action extends mfAction {
    
        
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));                
    }

}
