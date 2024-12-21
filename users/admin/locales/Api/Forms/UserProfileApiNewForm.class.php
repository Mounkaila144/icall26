<?php
require_once __DIR__.'/../../Forms/UserNewProfileForm.class.php';

class UserProfileApiNewForm extends UserNewProfileForm {
    
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
}
