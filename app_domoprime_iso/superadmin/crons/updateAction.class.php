<?php

class app_domoprime_iso_updateAction extends cronAction {
    
    function execute()
    {     
       foreach (SitesAdmin::getlistSitesByName() as $site)     
       {         
          try
          {
              if (!mfModule::isModuleInstalled('app_domoprime_iso', $site))
                  continue;   
              $number_of_requests=DomoprimeCustomerRequest::transferFormToRequest($site);
              
              
              $this->getCron()->getReport()->addMessage(sprintf("Site %s Number of forms processed %s",$site->get('site_db_name'),$number_of_requests));
          }
          catch (Exception $e)
          {
              $this->getCron()->getReport()->addMessage(sprintf("site [%s] : %s.",$site->getHost(),$e->getMessage()));
          }
      }    
      
    }
}
