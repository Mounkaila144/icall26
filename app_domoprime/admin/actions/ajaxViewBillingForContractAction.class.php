<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeBillingViewForm.class.php";

class app_domoprime_ajaxViewBillingForContractAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();      
        $this->contract=new CustomerContract($request->getPostParameter('Contract'));
        if ($this->contract->isNotLoaded())
            return ;
        $this->item=new DomoprimeBilling($request->getPostParameter('DomoprimeBilling'));
        $this->form= new DomoprimeBillingViewForm($this->item,$this->getUser());         
    }

}
