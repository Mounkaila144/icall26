<?php

class google_oauth_ajaxDialogViewConfigAction extends mfAction {
       
    
    function execute(mfWebRequest $request) {               
        $messages = mfMessages::getInstance();    
        $this->settings = new GoogleOauthSettings();
    }
    
   
}
 