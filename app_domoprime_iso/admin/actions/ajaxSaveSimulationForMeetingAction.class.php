<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSimulationViewForMeetingForm.class.php";

class app_domoprime_iso_ajaxSaveSimulationForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;
        $this->simulation=new DomoprimeSimulation($request->getPostParameter('DomoprimeSimulation'));
        $this->form= new DomoprimeSimulationViewForMeetingForm($this->simulation,$this->getUser(),$request->getPostParameter('DomoprimeSimulation'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeSimulation'))     
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeSimulation'));
        if ($this->form->isValid())
        {
            //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";            
            $this->simulation->updateFromMeeting($this->form,$this->getUser()->getGuardUser());
            $messages->addInfo(__('Simulation has been updated'));
            $request->addRequestParameter('meeting', $this->meeting);
            $this->forward($this->getModuleName(), 'ajaxListPartialSimulationForMeeting');
        }   
        else
        {
            $messages->addError(__("Form has some errors."));
           // echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
        }       
    }

}
