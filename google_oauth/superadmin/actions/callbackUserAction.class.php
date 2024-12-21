<?php

class google_oauth_callbackUserAction extends mfActions {

    function execute(mfWebRequest $request) {    
        $messages = mfMessages::getInstance();                 
        try 
        {                      
            $client = new GoogleClient();
            $settings =new GoogleOauthSettings(); 
                         
            $client->setAuthConfig ($settings->getFile());
            $client->setRedirectUri($settings->getSuperAdminUserUri());      
            
            $client->authenticate($request->getGetParameter('code'));                                    
            $access_token = $client->getAccessToken();
                         
            $client->setAccessToken($access_token);                          
             
            $client->authenticate($request->getGetParameter('code'));  
                         
           if (!$access_token) 
                throw new mfException(__('Error oauth google'));           
             $client->setAccessToken($access_token); 
            $oAuth = new Google_Service_Oauth2($client);
            $user = $oAuth->userinfo->get();

            
            $superadmin_user = new User($user->getEMail(),'superadmin'); 
            $superadmin_user->add(array(
                'firstname'=>$user->getGivenName(),                       
                'lastname'=>$user->getFamilyName(),
                'is_locked'=>'NO',
                'google_user'=>$user->getEMail(),
            ))->save(); 
            $superadmin_user->uploadAvatarFromUrl(new GooglePicture($user->getPicture()));
                 
            $this->getUser()->signin($superadmin_user,$request->getIp());
            $this->getEventDispather()->notify(new mfEvent($superadmin_user, 'user.connected'));               
            $this->redirect(to_link_i18n(mfConfig::get('mf_user_redirect_account')));  
        }
        catch (Exception $e) {     
                 $messages->addError($e);
                echo "<!-- ".$e->getMessage()." -->";
        }
        $this->forward($this->getModuleName (), 'callbackError');
}
}




