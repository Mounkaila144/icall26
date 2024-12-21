<?php


class app_domoprime_ajaxDisplayQuotationForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();      
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));
        if ($this->contract->isNotLoaded())        
            return ;     
        $this->quotation=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));                 
    }

}
