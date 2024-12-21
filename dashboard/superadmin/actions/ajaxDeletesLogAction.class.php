<?php

class dashboard_ajaxDeletesLogAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {       
        $messages=mfMessages::getInstance();
        try 
        {
           $selection=new mfValidatorLogFiles(count($request->getPostParameter('Selection')));
           $selection=new LogFileCollection($selection->isValid($request->getPostParameter('Selection')));
           $selection->delete();
           $response=array("action"=>"DeletesLog",
                           "selection"=>$request->getPostParameter('Selection'),
                           "info"=>__("Selection has been deleted.")
                          );
        } 
        catch (mfValidatorErrorSchema $e)
        {
            $messages->addErrors($e->getErrors());
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
        
    }
	
}

