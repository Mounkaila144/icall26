<?php

 
class site_oversight_ajaxSendAlertAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                             
        $this->user=$this->getUser();
        try
        {
           $engine = new SiteOversightEmailEngine();                
           $engine->sendAlert();               
           
           $response = array("action"=>"SendAlert",
                             "info"=>_('Alert has been sent'));
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

