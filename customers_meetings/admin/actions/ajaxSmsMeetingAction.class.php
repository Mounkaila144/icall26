<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_meetings_ajaxSmsMeetingAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'));    
          if (!$this->item->getCustomer()->get('mobile'))
           $messages->addWarning(__("Mobile doesn't exist, you have to complete it."));
    }

}
