<?php

class test_infoActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        $this->customer=$this->getParameter('customer');   
        $this->user=$this->getUser();
    } 
    
    
}