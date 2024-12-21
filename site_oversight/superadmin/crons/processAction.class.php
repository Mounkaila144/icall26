<?php

class site_oversight_processAction extends cronAction {
    
    function execute()
    {                
        foreach (SitesAdmin::getListActiveSitesByName() as $site)     
        {                
            try
            {
                if (!mfModule::isModuleInstalled('site_oversight', $site))
                    continue;                      
                $engine = new SiteOversightEngine($site);                
                $engine->process();

                $this->getCron()->getReport()->addMessage(__('Process oversight [site %s]',$site->get('site_db_name'))); 
            }           
            catch (Exception $e)
            {
                $this->getCron()->getReport()->addMessage(sprintf("site [%s] : %s.",$site->getHost(),$e->getMessage()));
            }
        }         
    }
}
