<?php

class customers_contracts_ajaxListAttributionsAction extends mfAction {
    
        
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));                
    }

}
