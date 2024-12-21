<?php

require_once dirname(__FILE__).'/../locales/Forms/CustomerContractRecipientForPolluterViewForm.class.php';

class app_domoprime_ajaxViewRecipientForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->polluter = new DomoprimePollutingCompany($request->getPostParameter('Polluter')); // new object       
        $this->form = new CustomerContractRecipientForPolluterViewForm(); 
        $this->item=new DomoprimePolluterRecipient($this->polluter);      
    }
    
}
