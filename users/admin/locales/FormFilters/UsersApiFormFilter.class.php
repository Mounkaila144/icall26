<?php

require_once __DIR__."/usersFormFilter.class.php";

class UsersApiFormFilter extends UsersFormFilter {
    
     function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
}