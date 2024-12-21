<?php



class system_resources_upgrade_14_Action extends mfModuleUpdate {
 
    function execute()
    {               
       $settings= new SystemResourceSettings($this->getSite());
       $settings->register('imagemagick','/system_resources/imagemagick');           
    }
}

