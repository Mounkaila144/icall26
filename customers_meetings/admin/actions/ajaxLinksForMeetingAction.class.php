<?php


class customers_meetings_ajaxLinksForMeetingAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));       
        if ($this->meeting->isNotLoaded())
            return ;  
    }
}

