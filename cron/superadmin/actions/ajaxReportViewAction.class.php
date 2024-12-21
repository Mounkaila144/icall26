<?php

class cron_ajaxReportViewAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->report=new File(mfCronController::getReportFile());
    }
	
}

