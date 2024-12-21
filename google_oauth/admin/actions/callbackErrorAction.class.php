<?php


class google_oauth_callbackErrorAction extends mfAction {
       
    
    function execute(mfWebRequest $request) {               
        $messages = mfMessages::getInstance();    
       // if (!$messages->hasMessages())
        //    $this->forwardTo401Action();           
    }
    
   
}
