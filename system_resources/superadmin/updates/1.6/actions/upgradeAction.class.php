<?php



class system_resources_upgrade_16_Action extends mfModuleUpdate {
 
    function execute()
    {               
       $settings= new SystemResourceSettings($this->getSite());
       $settings->register('pdfjam','/system_resources/pdfjam');           
    }
}

