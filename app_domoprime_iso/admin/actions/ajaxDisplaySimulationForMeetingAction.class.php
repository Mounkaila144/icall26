<?php


class app_domoprime_iso_ajaxDisplaySimulationForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();               
        $this->item=new DomoprimeSimulation($request->getPostParameter('DomoprimeSimulation'));       
    }

}
