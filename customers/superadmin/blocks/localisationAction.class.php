<?php

class customers_localisationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
         $customer=$this->getParameter('customer');          
         $this->address=$customer->getAddress();
        // $this->key=$this->getParameter('key');
        //var_dump($this->getParameter('id'));
    } 
    
    
}