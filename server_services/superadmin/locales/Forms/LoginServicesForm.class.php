<?php


class LoginServicesForm extends mfForm{
    
       function configure() {       
           
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
            'username' => new mfValidatorString(),
            'password' => new mfValidatorString(),            
        ));
        $this->validatorSchema->setPostValidator(new GuardValidatorUser());
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
