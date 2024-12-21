<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_meetings_ajaxPreviousMeetingAction extends mfAction {
    
       
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                               
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting')); 
        
        
        $this->target=$request->getPostParameter('target',"tab-site-panel-dashboard-customers-meeting");       
        $this->user=$this->getUser();
        if (!$this->meeting->isUserAuthorized($this->user))
            $this->forwardTo401Action(); 
        $this->meeting_settings=CustomerMeetingSettings::load();
        $this->form= new CustomerMeetingViewForm($this->user);  
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
