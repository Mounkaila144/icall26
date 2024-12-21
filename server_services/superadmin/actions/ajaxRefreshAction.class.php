<?php


class server_services_ajaxRefreshAction extends mfAction{
   
    public function execute(\mfWebRequest $request){
        
      
        $messages = mfMessages::getInstance(); 
        try
        {              
              $service = new SiteServicesServer();             
              $service->process();                 
              SiteServicesSettings::load()->setLastUpdate();
              $messages->addInfo(__('Servers have been updated.'));
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        $this->forward('site_services','ajaxListPartialSiteServices');
    }

}
