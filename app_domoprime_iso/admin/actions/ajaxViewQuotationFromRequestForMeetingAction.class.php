<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeQuotationViewForMeetingForm.class.php";

class app_domoprime_iso_ajaxViewQuotationFromRequestForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();       
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));
        if ($this->meeting->isNotLoaded())        
            return ;         
        $this->quotation=new DomoprimeQuotation($request->getPostParameter('DomoprimeQuotation'));
        $this->form= new DomoprimeQuotationViewForMeetingForm($this->quotation,$this->getUser());         
    }

}
