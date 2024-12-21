<?php

class server_services_updateAction extends cronAction {
    
    function execute()
    {          
       if (!mfModule::isModuleInstalled('site_services'))
                   return ;    
       //gestion des erreurs                
       try
        {
          $service = new SiteServicesServer();             
          $service->process(); 
          SiteServicesSettings::load()->setLastUpdate();
          $this->getCron()->getReport()->addMessage(__("Sites from servers have been updated."));                   
        }
        catch (Exception $e)
        {
            $this->getCron()->getReport()->addMessage(__("Error: %s",$e->getMessage()));
        }
    }
}
