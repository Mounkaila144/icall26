<?php

class site_ajaxDeleteLogAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        try 
        {
            $log=new logFile($request->getPostParameter('name').".log"); 
            if (!$log->isExist())
                throw new mfException(__("File [%s] doesn't exist",$request->getPostParameter('name').".log"));
            $log->delete();
            $response=array("action"=>"deleteLog","id"=>$request->getPostParameter('name'));
        } 
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;        
    }
	
}

