<?php



class system_resources_upgrade_10_Action extends mfModuleUpdate {
 
    function execute()
    {               
       $settings= new SystemResourceSettings($this->getSite());
       $settings->register('pdftk','/system_resources/pdftk');        
    }
}

