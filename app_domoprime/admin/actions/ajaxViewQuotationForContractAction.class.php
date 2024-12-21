<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationViewForContractForm.class.php";

class app_domoprime_ajaxViewQuotationForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();      
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));
        if ($this->contract->isNotLoaded())        
            return ;     
        $this->quotation=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));
        $this->form= new DomoprimeQuotationViewForContractForm($this->quotation,$this->getUser());             
    }

}
