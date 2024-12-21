<?php

class cron_ajaxExecuteAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        
        try
        {
            $cron=new Cron($request->getPostParameter('cron'));
            if ($cron->isLoaded())
            {    
                $cronController=new mfCronController();
                $cronController->run($cron);
                $response=array("info"=>__("cron task executed."));
            }
        }
        catch (mfException $e) {
          $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

