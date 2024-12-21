<?php

class app_mutual_processCalculationForAllMeetingsAction extends cronAction {
    
    function execute()
    {
        $messages = mfMessages::getInstance();
        try
        {                       
            $this->scheduler = new MutualEngineCalculationMeetingScheduler();
            $this->scheduler->process();
            $messages->addInfo(__('Calculation finished.'));
        }
        catch (mfException $e)
        {
            $message->addError($e);
        }
        $this->getCron()->getReport()->addMessage($message);
    }
}
