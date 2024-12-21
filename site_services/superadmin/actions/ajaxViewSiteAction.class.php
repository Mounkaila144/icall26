<?php

require_once __DIR__."/../locales/Forms/SiteServicesViewDescriptionForm.class.php";

class site_services_ajaxViewSiteAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();        
        $this->item=new SiteServicesSite($request->getPostParameter('SiteServicesSite'));    
        $this->form=new SiteServicesViewDescriptionForm();
    }

  

}
