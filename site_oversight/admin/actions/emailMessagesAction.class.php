<?php

class site_oversight_emailMessagesAction extends mfAction {

    
    function execute(mfWebRequest $request)
    {      
        $engine=$this->getParameters();
        //$this->company=$engine->getCompany();        
        $this->messages=$engine->getMessages();
    } 
    
    
}