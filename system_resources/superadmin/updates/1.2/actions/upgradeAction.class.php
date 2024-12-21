<?php



class system_resources_upgrade_12_Action extends mfModuleUpdate {
 
    function execute()
    {               
       $settings= new SystemResourceSettings($this->getSite());
       $settings->register('wkhtmltoimage','/system_resources/wkhtmltoimage');           
    }
}

