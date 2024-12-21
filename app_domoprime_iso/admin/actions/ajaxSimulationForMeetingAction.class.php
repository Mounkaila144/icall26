<?php


class app_domoprime_iso_ajaxSimulationForMeetingAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser(); 
         $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;        
        $this->simulation=new DomoprimeSimulation();
        $this->simulation->createFromMeeting($this->meeting,$this->user->getGuardUser());
    }
    
}    