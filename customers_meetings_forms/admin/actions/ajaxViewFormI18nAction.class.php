<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormViewForm.class.php";
 
class customers_meetings_forms_ajaxViewFormI18nAction extends mfAction {
    
        
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerMeetingFormViewForm();
        $this->item=new CustomerMeetingFormI18n($request->getPostParameter('CustomerMeetingFormI18n'));                
   }

}

