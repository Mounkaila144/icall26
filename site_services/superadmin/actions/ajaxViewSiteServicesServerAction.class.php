<?php

require_once dirname(__FILE__).'/../locales/Forms/SiteServicesServerForm.class.php';

class site_services_ajaxViewSiteServicesServerAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();              
        $this->form=new SiteServicesServerForm($request->getPostParameter('SiteServicesServer'));
        $this->item=new SiteServicesServer($request->getPostParameter('SiteServicesServer')); 
    }

}
