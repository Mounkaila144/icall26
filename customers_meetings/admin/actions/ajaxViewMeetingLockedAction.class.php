<?php


class customers_meetings_ajaxViewMeetingLockedAction extends mfAction {
                 
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                               
        $this->meeting=$request->getRequestParameter('CustomerMeeting'); 
        $messages->addWarning(__('Meeting is used by %s',strtoupper((string)$this->meeting->getUserLock())));  
        $this->user=$this->getUser();
        if (!$this->meeting->isUserAuthorized($this->user))
            $this->forwardTo401Action();                         
        $this->meeting_settings=CustomerMeetingSettings::load();
    }

}
