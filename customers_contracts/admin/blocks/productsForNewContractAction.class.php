<?php

class customers_contracts_productsForNewContractActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {              
       $this->user=$this->getUser();
    } 
    
    
}