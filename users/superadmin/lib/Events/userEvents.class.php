<?php

class UserEvents {
        
    static function listenUserSignin(mfEvent $event)
    {
       $user=$event->getSubject();
     //  mfContext::getInstance()->getMailer()->sendMail('users','emailSignin',array("noreply@ewebsolutions.fr"=>"superadmin"), $user->get('email'), __("Notification of connexion to your account"),$user); 
    }
    
    static function userChange(mfEvent $event)
    {
        // Event called only for Delete see parameters = 'delete'
        $user=$event->getSubject();
        $action=$event->getParameters();
        $dirs=array(
                 // Super Admin
                 mfConfig::get('mf_site_superadmin_dir')."/data/pdf/users",
                 mfConfig::get('mf_site_superadmin_dir')."/data/csv/users",
                 // Application
                 mfConfig::get('mf_sites_dir')."/".$user->getSiteName()."/".$user->get('application')."/data/pdf/users",  
                 mfConfig::get('mf_sites_dir')."/".$user->getSiteName()."/".$user->get('application')."/data/csv/users",
        );
        if ($action=='delete')
        {
           $dirs[]=$user->getDirectory();
        }    
        mfFileSystem::net_rmdirs($dirs);
        
    }
    
    static function usersChange(mfEvent $event)
    {
        $users=$event->getSubject();
        $action=$event->getParameters();
        $dirs=array( 
            // Super Admin
            mfConfig::get('mf_site_superadmin_dir')."/data/pdf/users",
            mfConfig::get('mf_site_superadmin_dir')."/data/csv/users",
            // Application
            mfConfig::get('mf_sites_dir')."/".$users->getSiteName()."/".$users->getApplication()."/data/pdf/users",  
            mfConfig::get('mf_sites_dir')."/".$users->getSiteName()."/".$users->getApplication()."/data/csv/users"
            );
        if ($action=='delete')
        {
            foreach ($users as $user)
                  $dirs[]=$user->getDirectory();
        }
        mfFileSystem::net_rmdirs($dirs);
    }
    
    static function initializationFormConfig(mfEvent $event)
    {         
         $form=$event->getSubject();
         // echo "User ICI COnfig";
         $form->setValidator('users_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {                        
        $form=$event->getSubject();                   
        if ($form->getValue('users_clean'))
        {               
           UserUtils::initializeSite($form->getSite());
        }        
    }
    
    static function userConnected(mfEvent $event)
    {                        
        $user=$event->getSubject();                   
        if ($user->get('username')=='services')
            return ;
      //  if (mfConfig::get('mf_env')=='dev')
      //      return ;
        $engine=new UserEmailEngine($user);
        $engine->sendAuthentification();
    }
}

