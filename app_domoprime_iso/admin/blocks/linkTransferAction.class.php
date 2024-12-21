<?php



class app_domoprime_iso_linkTransferActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                        
        $this->user=$this->getUser();
        
        $this->number_of_requests=DomoprimeCustomerRequest::getNumberOfTransferredRequest();
       // $this->number_of_forms=CustomerMeetingForms::getNumberOfForms();
         $this->number_of_forms=DomoprimeCustomerRequest::getNumberOfForm();
    } 
    
    
}