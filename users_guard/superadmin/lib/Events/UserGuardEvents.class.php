<?php

class UserGuardEvents {
        
        
    static function cleanUp(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('users_guard'))
            return;  
         SessionUtils::cleanUpAllSites();
    }
    
    static function setNumberOfSessionsForSites(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('users_guard'))
            return;  
        $sites = $event->getSubject();
        
    }
}

