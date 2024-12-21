<?php

class customers_infoActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
         $this->customer=$this->getParameter('customer');   
         $this->is_hold=$this->getParameter('is_hold',false);   
         $this->user=$this->getUser();
    } 
    
    
}