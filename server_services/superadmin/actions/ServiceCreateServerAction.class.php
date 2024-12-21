<?php

class ServiceCreateServerForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'name'=>new mfValidatorString(),
           // 'user'=>new mfValidatorString(),
            'password'=>new mfValidatorString(),
            'ip'=>new mfValidatorIp(),
            'host'=>new mfValidatorDomain(),
        ));
    }
    
    static function getToken()
    {
        return iCall26SiteServiceApi::getKey().session_id();   
    }
  
    public function getCSRFToken()
    {
        return self::getToken();
    }
}

class server_services_ServiceCreateServerAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
     
      return array('status'=>'OK','server'=>'OK');
    }

}
