<?php

class dashboard_ajaxRemoveLogsAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {       
        $messages=mfMessages::getInstance();
        try 
        {
           LogsUtils::removeAll();
           $response=array("action"=>"RemoveLogs",                         
                           "info"=>__("All logs have been deleted.")
                          );
        } 
        catch (mfValidatorErrorSchema $e)
        {
            $messages->addErrors($e->getErrors());
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
        
    }
	
}

