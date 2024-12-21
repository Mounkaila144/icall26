<?php

class marketing_leads_ajaxCleanUpAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        try
        {
            $engine = new MarketingLeadsCleanUpEngine();
            $engine->process();
            $response = array('info'=>__("Process finished with success."));
        }
        catch (mfException $e)
        {
            $messages->addError($e);  
        }
        
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }
}


