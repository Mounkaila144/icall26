<?php


class app_domoprime_resultsForNewMeetingActionComponent extends mfActionComponent {

        
    
    function execute(mfWebRequest $request)
    {                       
       $this->meeting=$this->getParameter('meeting'); 
       try 
       {                  
            $this->engine=new DomoprimeEngine($this->meeting);
            $this->engine->process();       
            $this->report=new DomoprimeCalculation($this->engine);
            $this->report->process($this->getUser()->getGuardUser());             
            if ($this->getUser()->hasCredential(array(array('app_domoprime_transfert_authorized'))))
                 return ;   
            if ($this->report->isAccepted())
            {
               $this->report->getMeeting()->set('state_id',CustomerMeetingSettings::load()->get('status_transfer_to_contract_id'))->save();
               $this->getEventDispather()->notify(new mfEvent($this->report->getMeeting(), 'meeting.change'));                                      
            }
       } 
       catch (mfException $ex) {
           $this->getMessage()->addError($e);
       }
    } 
    
    
}