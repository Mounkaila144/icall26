<?php


class customers_meetings_forms_ajaxViewerAction extends mfAction {
    
        
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));       
        if ($this->meeting->isNotLoaded())
            return ;
        $this->forms=new CustomerMeetingForms($this->meeting);       
   }

}

