<?php

class app_mutual_ajaxMeetingCalculationSchedulerTesterAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        
        $messages = mfMessages::getInstance();
        
        try 
        {
           $this->scheduler = new MutualEngineCalculationMeetingScheduler();
           $this->scheduler->process();
        }       
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
        
        return mfView::NONE;
    }
}
  