<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_meetings_ajaxEmailMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                     
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);        
        $this->country=$this->getUser()->getCountry();
        if (!$this->item->getCustomer()->get('email'))
           $messages->addWarning(__("Email doesn't exist, you have to complete it."));
    }

}
