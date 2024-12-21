<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerModifyForm.class.php";
 
class customers_ajaxModifyCustomerForContractAction extends mfAction {
    
    
    

        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract')); 
        if ($this->contract->isNotloaded())
            return ;
        $this->form = new CustomerModifyForm($this->user,array());      
   }

}

