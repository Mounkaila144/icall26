<?php

class cron_ajaxReportCronViewAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->cron= new Cron($request->getPostParameter('cron'));
    }
	
}

