<?php

class dashboard_processAction extends cronAction {
    
    function execute()
    {        
        try
        {                   
            LogsUtils::deleteLogsForCron();  
            LogsUtils::deleteCronLogsForCron();
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($this,'cron.dashboard.process'));
            $this->getCron()->getReport()->addMessage(__('Logs deleted.'));
        }
        catch (mfException $e)
        {
           $this->getCron()->getReport()->addMessage(__("Log: Error system"));
        }      
    }
}
