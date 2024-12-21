<?php


class users_myProfileActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->user=$this->getUser()->getGuardUser();    
    } 
    
    
}

