<?php

require_once __DIR__."/../../Forms/UserViewProfileForm.class.php";

class UserApiViewProfileForm extends UserViewProfileForm {
    
            
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
}