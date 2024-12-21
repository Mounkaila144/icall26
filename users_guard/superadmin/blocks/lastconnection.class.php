<?php


class userGuard_lastconnection_block extends mfBlock {

    
    function execute(mfWebRequest $request)
    {
       $this->user=$this->getUser()->getGuardUser();            
    } 
    
    
}

