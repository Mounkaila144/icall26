<?php

class customers_newForNewContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                     
         $this->customer_settings=CustomerSettings::load();  
    } 
    
    
}