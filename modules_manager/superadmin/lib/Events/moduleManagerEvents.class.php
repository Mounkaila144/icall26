<?php

class moduleManagerEvents {
        
    static function moduleInstall(mfEvent $event)
    {               
       // $installer=$event->getSubject();     
        $module=$event->getSubject();    
        // Check if modules_manager is installed
        if (!mfModule::isModuleInstalled('modules_manager',$module->getSite()))                          
            return;
        if ($module->isCore())
            return ;           
        $moduleManager=new moduleManager($module);           
        // Create / Update module only if type is not core or base
        $moduleManager->setConfigFromModule();        
        $moduleManager->add(array('is_available'=>'YES','status'=>'installed'));        
        $moduleManager->save();
        $moduleManager->getModule()->removeConfigCache();       
    }
    
    static function moduleUninstall(mfEvent $event)
    {                     
        $module=$event->getSubject();
        $module->removeConfigCache();
        if (!mfModule::isModuleInstalled('modules_manager',$module->getSite()))                          
            return;
        if ($module->isCore())
            return ;
        $moduleManager=new moduleManager($module);  
        if ($moduleManager->isLoaded())
        {
            $moduleManager->set('status','loaded');        
            $moduleManager->save();   
        }                    
    }     
    
    static function siteCreated(mfEvent $event)
    {
        $site=$event->getSubject();
        moduleManagerUtils::buildModulesList($site);
    }
}

