<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_meetings_ajaxViewMeetingAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();          
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));         
        if ($this->meeting->getCustomer()->isPhoneNotUnique())
           $messages->addWarning(__('Phone already exits.'));
        if ($this->meeting->getCustomer()->isMobileNotUnique())
           $messages->addWarning(__('Mobile already exits.'));
         if ($this->meeting->isHold())
            $messages->addWarning(__('Meeting is hold.')); 
        $this->target=$request->getPostParameter('target',"tab-site-panel-dashboard-customers-meeting");       
        $this->user=$this->getUser();
        if (!$this->meeting->isUserAuthorized($this->user))
            $this->forwardTo401Action(); 
        $this->meeting_settings=CustomerMeetingSettings::load();
        $this->form= new CustomerMeetingViewForm($this->user,$this->meeting);  
        $this->getEventDispather()->notify(new mfEvent($this->form, 'meeting.form',['action'=>'view']));            
        if (!$this->meeting_settings->hasLock())
            return ;
        if (!$this->meeting->getLock($this->user->getGuardUser()))
        {                
            $request->addRequestParameter('CustomerMeeting', $this->meeting);
            $this->forward('customers_meetings','ajaxViewMeetingLocked');
        }    
        if ($this->meeting->isLoaded())
            $this->meeting->save();               
    }

}
