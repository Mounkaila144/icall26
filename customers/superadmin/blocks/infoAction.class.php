<?php

class customers_infoActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
         $this->customer=$this->getParameter('customer');          
       //  $this->address=$customer->getAddress();
        // $this->key=$this->getParameter('key');
        //var_dump($this->getParameter('id'));
        // var_dump($customer);
    } 
    
    
}