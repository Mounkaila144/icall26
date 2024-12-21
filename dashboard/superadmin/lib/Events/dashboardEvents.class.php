<?php

class dashboardEvents {
        
    static function moduleUpdate(mfEvent $event)
    {               
        $module=$event->getSubject();         
        // Remove menu cache               
        MenuManager::removeCache($module->getSite());
        // Remove tabs cache        
        TabsManager::removeCache($module->getSite());
    }
    
    
    

}

