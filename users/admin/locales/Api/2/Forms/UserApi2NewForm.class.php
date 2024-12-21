<?php

require_once __DIR__.'/../../../Forms/UserNewForm.class.php';

class UserApi2NewForm extends UserNewForm {
   
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
        unset($this['repassword']);
        $this->validatorSchema->removePostValidator();
    }
    
    function getData()
    {
        return $this->data = $this->data===null?new UserNewFormatterApi2($this):$this->data;     
    }
}
