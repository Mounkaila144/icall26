<?php

class google_oauth_callbackUserAction extends mfActions {

    function execute(mfWebRequest $request) {    
        $messages = mfMessages::getInstance();                 
        try 
        {                      
            $client = new GoogleClient();
            $settings =new GoogleOauthSettings(); 
                         
            $client->setAuthConfig($settings->getFile());
            $client->setRedirectUri($settings->getUserUri());      

            $client->authenticate($request->getGetParameter('code'));                                    
            $access_token = $client->getAccessToken();
                         
            $client->setAccessToken($access_token);                          
             
            $client->authenticate($request->getGetParameter('code'));  
                         
            if (!$access_token) 
                throw new mfException(__('Error oauth google'));           
             $client->setAccessToken($access_token); 
            $oAuth = new Google_Service_Oauth2($client);
            $google_user = $oAuth->userinfo->get();
            
            
       //     var_dump($google_user);die(__METHOD__);
            
            $user = new User($google_user->getEMail(),'admin'); 
            if ($user->isNotLoaded())
            {                                
                $this->getEventDispather()->notify(new mfEvent($this, 'user.failed.login', array('ip'=>$request->getIp(),'method'=>'google','username'=>$google_user->getEMail(),'password'=>'google')));
                $messages->addInfo(__('Email/Username/Password are invalid.'));
                $this->forward ('users_guard','login');
            }
            $user->add(array(
              //  'firstname'=>$user->getGivenName(),                       
              //  'lastname'=>$user->getFamilyName(),               
                'is_locked'=>'N'
            ))->save(); 
            if (!$user->hasAvatar())
            {    
                $user->uploadAvatarFromUrl(new GooglePicture($google_user->getPicture()));
            }
            // set method  log
            $this->getUser()->signin($user,$request->getIp());
            $this->getEventDispather()->notify(new mfEvent($user, 'user.connected'));               
            $this->redirect(to_link_i18n(mfConfig::get('mf_user_redirect_account')));  
        }
        catch (Exception $e) {     
                 $messages->addError($e);
                 echo "<!-- ".$e->getMessage()." -->";
        }
        $this->forward($this->getModuleName (), 'callbackError');
}
}




