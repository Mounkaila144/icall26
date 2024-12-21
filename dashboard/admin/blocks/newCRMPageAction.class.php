<?php

class dashboard_newCRMPageActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
       $this->user=$this->getUser();
       $this->url=url_to("dashboard",array('action'=>'settings'));       
    } 
    
}