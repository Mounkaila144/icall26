<?php


class server_services_ajaxExploreSiteServicesServerAction extends mfAction{
   
    
    public function execute(\mfWebRequest $request) {        
        $messages = mfMessages::getInstance();              
        $this->actions=ActionsManager::getInstance('dashboard-site-services'); 
        $this->user=$this->getUser();   
    }
    

}
