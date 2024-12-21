<?php



class system_resources_upgrade_13_Action extends mfModuleUpdate {
 
    function execute()
    {               
       $settings= new SystemResourceSettings($this->getSite());
       $settings->register('node.js','/system_resources/nodejs');           
    }
}

