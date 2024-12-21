<?php

class customers_meetings_ajaxListMeetingProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
                
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting'),$this->site));               
    }

}
