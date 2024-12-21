<?php


class customers_ajaxViewCustomerForContractAction extends mfAction {
    
    
    

    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));                
        $this->customer=$this->contract->getCustomer();
   }

}

