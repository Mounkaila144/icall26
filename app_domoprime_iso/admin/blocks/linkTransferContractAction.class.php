<?php



class app_domoprime_iso_linkTransferContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                        
        $this->user=$this->getUser();
        
        $this->number_of_requests=DomoprimeCustomerRequest::getNumberOfTransferredRequestForContracts();      
         $this->number_of_forms=DomoprimeCustomerRequest::getNumberOfFormForContracts();
    } 
    
    
}