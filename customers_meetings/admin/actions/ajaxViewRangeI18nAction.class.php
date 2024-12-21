<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingRangeViewForm.class.php";
 
class customers_meetings_ajaxViewRangeI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {              
     
        $messages = mfMessages::getInstance();
        $this->form = new CustomerMeetingRangeViewForm();
        $this->item=new CustomerMeetingRangeI18n($request->getPostParameter('CustomerMeetingRangeI18n'));        
   }

}

