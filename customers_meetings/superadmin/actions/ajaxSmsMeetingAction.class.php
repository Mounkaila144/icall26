<?php

class customers_meetings_ajaxSmsMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                      
        $this->item=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);   
        if (!$this->item->getCustomer()->get('mobile'))
           $messages->addWarning(__("Mobile doesn't exist, you have to complete it."));
    }

}
