<?php



class app_domoprime_iso_ajaxResultsForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));       
        try 
        {           
           $this->engine=new DomoprimeIsoEngine($this->meeting);
           $this->engine->process();                                    
           $this->report=new DomoprimeCalculation($this->engine);
           $this->report->process($this->getUser()->getGuardUser());               
        } 
        catch (mfException $e) 
        {
            $messages->addError($e->getMessage());
        }
      //   var_dump($this->engine->getCauses());
    }

}
