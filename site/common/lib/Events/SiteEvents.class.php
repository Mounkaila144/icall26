<?php

class SiteEvents {
     
 
    static function lastConnection(mfEvent $event)
    {         
        $user_connected=$event->getSubject();
        if (!mfModule::isModuleInstalled('users', $user_connected->getSite()))
             return ;                             
        $site=$user_connected->getSite();  
        $site->set('last_connection',$user_connected->get('lastlogin'));
        $site->save();        
                      
    }
    
    

    
}

