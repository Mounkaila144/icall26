<?php
require_once dirname(__FILE__).'/../../../common/lib/Forms/RegistrationFormBase.class.php';

class RegistrationNewForm extends RegistrationFormBase {
    
   function configure()
    {
        parent::configure(); 
        unset($this['id']);
        if (!$this->hasDefaults()){
            $this->setDefaults(array());
        }

    }
    
}
