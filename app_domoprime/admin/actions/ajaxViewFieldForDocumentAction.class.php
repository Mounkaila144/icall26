<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormDocumentFormFieldForDocumentViewForm.class.php";

class app_domoprime_ajaxViewFieldForDocumentAction extends mfAction {

       
        
    function execute(mfWebRequest $request) {
       $messages = mfMessages::getInstance();                             
       $this->item=new CustomerMeetingFormDocumentFormfield($request->getPostParameter('CustomerMeetingFormDocumentField'));
       $this->form=new CustomerMeetingFormDocumentFormfieldForDocumentViewForm($request->getPostParameter('CustomerMeetingFormDocumentField'));                                                            
    }
    
}    