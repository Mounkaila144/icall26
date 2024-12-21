<?php

class userGuard_authentifiedActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {
             
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser()->getGuardCustomer();
        //var_dump($this->user);         
    } 
    
    
}
