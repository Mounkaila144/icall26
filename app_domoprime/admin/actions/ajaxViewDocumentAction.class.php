<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormDocumentViewForm.class.php";

class app_domoprime_ajaxViewDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();              
        $this->item=new CustomerMeetingFormDocument($request->getPostParameter('CustomerMeetingFormDocument'));
        $this->form=new CustomerMeetingFormDocumentViewForm();                                 
        $this->doc_form_class=new DomoprimeCustomerMeetingFormDocumentClass($this->item);     
    }
    
}    