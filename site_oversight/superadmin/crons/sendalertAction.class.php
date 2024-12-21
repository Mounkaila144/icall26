<?php

class site_oversight_sendalertAction extends cronAction {
    
    function execute()
    {                
        foreach (SitesAdmin::getListActiveSitesByName() as $site)     
        {                
            try
            {
                if (!mfModule::isModuleInstalled('site_oversight', $site))
                    continue;                      
                $engine = new SiteOversightEmailEngine($site);                
                $engine->sendAlert();

                $this->getCron()->getReport()->addMessage(__('Process oversight emails sent [site %s]',$site->get('site_db_name'))); 
            }           
            catch (Exception $e)
            {
                $this->getCron()->getReport()->addMessage(sprintf("site [%s] : %s.",$site->getHost(),$e->getMessage()));
            }
        }         
    }
}
