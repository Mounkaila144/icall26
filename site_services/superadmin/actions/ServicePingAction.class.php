<?php


class site_services_ServicePingAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
     
      return array('status'=>'OK','ping'=>'OK');
    }

}
