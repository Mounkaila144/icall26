<?php


class server_services_ServiceMasterPingAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
     
      return array('status'=>'OK','ping'=>'OK');
    }

}
