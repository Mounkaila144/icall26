<?php

class google_oauth_oauthBtnUserActionComponent extends mfActionComponent  {

    function execute(mfWebRequest $request) {    
        try
        {            
            $client = new GoogleClient();
            $settings =new GoogleOauthSettings();                            
            $client->setAuthConfig($settings->getConfigs()->toArray());                   
            //$client->setAuthConfig($settings->getFile()); 
            $client->addScope([Google_Service_Oauth2::USERINFO_PROFILE,Google_Service_Oauth2::USERINFO_EMAIL]);   
            $client->setRedirectUri($settings->getUserUri());      
            $this->auth_url = $client->createAuthUrl();               
            $this->target=$this->getParameter('target','_blank');
              
        } 
        catch (Exception $ex) {
            $this->error=$ex->getMessage();
        }
    }
}

