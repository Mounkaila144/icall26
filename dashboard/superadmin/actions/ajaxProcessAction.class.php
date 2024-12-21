<?php

class dashboard_ajaxProcessAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try
        {                       
            LogsUtils::deleteOldLogs();        
            $messages->addInfo(__('Logs deleted.'));
        }
        catch (mfException $e)
        {
            $message->addError($e);
        }
        return mfView::NONE;
    }
}
