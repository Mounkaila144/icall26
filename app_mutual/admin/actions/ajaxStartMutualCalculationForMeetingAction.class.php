<?php

require_once dirname(__FILE__).'/../locales/Forms/Calculation/CustomerMeetingMutualCalculationForm.class.php';

class app_mutual_ajaxStartMutualCalculationForMeetingAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        
        $messages = mfMessages::getInstance();
        
        $this->meeting = new CustomerMeetingMutual($request->getPostParameter("Meeting"));
        $this->form = new CustomerMeetingMutualCalculationForm($request->getPostParameter("MeetingMutualCalculation"));
        if($this->meeting->isNotLoaded())
        {
            $this->getController()->setRenderMode(mfView::RENDER_JSON);
            return array("error"=>__("Meeting not loaded.")); 
        }
            
        try 
        {
            $this->form->bind($request->getPostParameter("MeetingMutualCalculation"));
            if($this->form->isValid())
            {
                $this->engine_core = new AppMutualEngineCore($this->meeting, $this->form->getValue('date_calculation'));
                $this->engine_core->process();
                $this->engine_calculation = new MutualEngineCalculationMeeting($this->engine_core);
                $messages->addInfo(__("Calculation finished."));
            }
            else
            {
                $this->getController()->setRenderMode(mfView::RENDER_JSON);
                return array("error"=>__("Form has some errors.")); 
            }
        }       
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
        
    }
}
  