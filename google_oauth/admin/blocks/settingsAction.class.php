<?php

class google_oauth_settingsActionComponent extends mfActionComponent {
    
    
    function execute(mfWebRequest $request)
    {       
         $this->settings = new GoogleOauthSettings();
    } 
    
   
}

