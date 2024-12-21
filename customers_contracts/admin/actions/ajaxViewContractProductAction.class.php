<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractProductViewForm.class.php";



class customers_contracts_ajaxViewContractProductAction extends mfAction {
    
        
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                           
        $this->item=new  CustomerContractProduct($request->getPostParameter('ContractProduct'));  
        $this->user=$this->getUser();
        $this->form=new CustomerContractProductViewForm(array(),$this->user);        
    }

}
