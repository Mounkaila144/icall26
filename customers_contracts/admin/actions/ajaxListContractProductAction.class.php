<?php

class customers_contracts_ajaxListContractProductAction extends mfAction {
    
        
                
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->contract=$request->getRequestParameter('contract',new CustomerContract($request->getPostParameter('Contract')));       
        $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.view.product.list'));  
    }

}
