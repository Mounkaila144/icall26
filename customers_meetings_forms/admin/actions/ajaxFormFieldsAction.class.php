<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormForm.class.php";
 
class customers_meetings_forms_ajaxFormFieldsAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();                     
        $this->item=new CustomerMeetingFormI18n($request->getPostParameter('CustomerMeetingFormI18n'));            
        $this->form=new CustomerMeetingFormForm($this->item->getDefaultFormfields());             
   }

}

