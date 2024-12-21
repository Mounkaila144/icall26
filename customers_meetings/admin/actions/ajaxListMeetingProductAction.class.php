<?php

class customers_meetings_ajaxListMeetingProductAction extends mfAction {
    
       
                
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                        
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));       
        $this->user=$this->getUser();
    }

}
