<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSimulationNewForMeetingForm.class.php";

class app_domoprime_iso_ajaxNewSimulationForMeetingAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        $this->user=$this->getUser();
        $this->meeting=$request->getRequestParameter('meeting',new CustomerMeeting($request->getPostParameter('Meeting')));
        if ($this->meeting->isNotLoaded())
            return ;
        $this->simulation=new DomoprimeSimulation();               
        $this->form= new DomoprimeSimulationNewForMeetingForm($this->meeting,$request->getPostParameter('DomoprimeSimulation'));
        if ($this->form->getProducts()->isEmpty())
            $messages->addWarning(__('No surface exists.'));
        
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeSimulation'))     
            return ;
        try
        {
            $this->form->bind($request->getPostParameter('DomoprimeSimulation'));
            if ($this->form->isValid())
            {
                //echo "<pre>"; var_dump($this->form->getValues()); echo "</pre>";             
                $this->simulation->createFromMeeting($this->meeting,$this->form,$this->getUser()->getGuardUser());
                $messages->addInfo(__('Simulation has been created'));
                $request->addRequestParameter('meeting', $this->meeting);
                $this->forward($this->getModuleName(), 'ajaxListPartialSimulationForMeeting');
            }   
            else
            {
                $messages->addError(__("Form has some errors."));
               // echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        }
        catch (DomoprimeSimulationEngineException $e)
        {
            $messages->addError($e->getI18n());
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
