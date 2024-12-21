<?php



class system_resources_upgrade_11_Action extends mfModuleUpdate {
 
    function execute()
    {               
       $settings= new SystemResourceSettings($this->getSite());
       $settings->register('zip','/system_resources/zip');        
    }
}

