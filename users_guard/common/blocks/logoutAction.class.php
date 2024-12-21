<?php

class users_guard_logoutActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {    
        $this->user=$this->getUser()->getGuardUser();
    } 
    
    
}

