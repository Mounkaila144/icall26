<?php

class dashboard_ajaxDeleteLogAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        if (!$request->isXmlHttpRequest())
          return mfView::NONE;
        $messages=mfMessages::getInstance();
        $logValidator=new mfValidatorLogFile();
        $logValidator->addMessages(array(
                                         'file'=> __("file [{value}] doesn't exist"),
                                         'invalid'=> __("the file [{value}] is invalid")
                                         )
                                   );
        try 
        {
            $log=$logValidator->isValid($request->getPostParameter('name'));
            $log->delete();
            $response=array("action"=>"delete","id"=>$log->getName('log'));
        } 
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        $response=$messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
        return $response;
    }
	
}

