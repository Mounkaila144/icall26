<?php

class dashboardEvents {
        
    static function moduleUpdate(mfEvent $event)
    {                     
        // Remove menu cache               
        MenuManager::removeCache();
        // Remove tabs cache        
        TabsManager::removeCache();
    }
    
    
    

}

