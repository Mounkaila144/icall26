<?php

class google_oauth_ExportConfigJsonAction extends mfAction {
       
    
    function execute(mfWebRequest $request) {               
        $messages = mfMessages::getInstance();    
        $settings = new GoogleOauthSettings();
        
         ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHttpHeader('Content-Type','application/json');
           $response->sendHttpHeaders();  
           echo $settings->get('google_oauth_configs');                                               
           die();
    }
    
   
}
 
