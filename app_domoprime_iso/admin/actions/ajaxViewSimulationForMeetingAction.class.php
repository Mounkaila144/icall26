<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSimulationViewForMeetingForm.class.php";

class app_domoprime_iso_ajaxViewSimulationForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();       
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));
        if ($this->meeting->isNotLoaded())        
            return ;         
        $this->simulation=new DomoprimeSimulation($request->getPostParameter('DomoprimeSimulation'));
        $this->form= new DomoprimeSimulationViewForMeetingForm($this->simulation,$this->getUser());         
    }

}
