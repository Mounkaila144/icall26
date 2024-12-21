<?php

class customers_meetings_callbacksActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {                     
        $settings=CustomerMeetingSettings::load();
        if ($settings->get('has_callback')!='YES' || !$this->getUser()->hasCredential(array(array('superadmin','admin','notification_meeting_callbacks'))))
            return mfView::NONE;
        $this->scheduler_time=$this->scheduler_time=$settings->getCallBackTimeScheduler(); // seconds => ms
        $this->callbacks=  CustomerMeetingUtils::getCallbacks($this->getUser());      
    } 
    
    
}