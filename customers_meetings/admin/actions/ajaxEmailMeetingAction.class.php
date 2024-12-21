<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_meetings_ajaxEmailMeetingAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'));  
        $this->country=$this->getUser()->getCountry();
          if (!$this->item->getCustomer()->get('email'))
           $messages->addWarning(__("Email doesn't exist, you have to complete it."));
    }

}
