<?php

require_once __DIR__.'/../../Forms/UserNewForm.class.php';

class UserApiNewForm extends UserNewForm{
   
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
}
