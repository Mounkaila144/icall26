<?php

class app_domoprime_emailBillingAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {    
       // Affected local data
        $billing=$this->getParameter('billing'); 
        $email=$this->getParameter('email'); 
        DomoprimeBillingModelParameters::loadParametersForEmailBilling($billing,$this);   
       // Data used on template                             
       $this->body=$email->getModel()->getI18n()->get('body');                                
    }

}
