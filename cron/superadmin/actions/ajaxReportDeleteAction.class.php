<?php

class cron_ajaxReportDeleteAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $report=new File(mfCronController::getReportFile());
        $report->delete();
        return array("action"=>"ReportDelete","info"=>__("cron report has been deleted."));
    }
	
}

