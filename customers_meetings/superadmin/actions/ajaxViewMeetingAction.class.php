<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForm.class.php";



class customers_meetings_ajaxViewMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->form= new CustomerMeetingViewForm(array(),$this->site);
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);
        $this->meeting_settings=CustomerMeetingSettings::load($this->site);          
       // var_dump($this->meeting);
       // echo $this->meeting->get('in_at');
    }

}
