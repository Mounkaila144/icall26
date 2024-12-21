<?php

class cron_executeAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $cronController=new mfCronController();
        try
        {         
            if (in_array($request->getGetParameter('name'),$cronsAllowed=$cronController->getListCrons()))
            {
                $cronController->run($request->getGetParameter('name'));
                $this->cron=$cronController->getCron();
            }        
            else
               $messages->addError(__("cron task doesn't exist."));
        }
        catch (mfException $e)
        {
            
        }
    }
}

