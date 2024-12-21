<?php

class customers_contracts_attributions2ActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {              
       $contract=$this->getParameter('contract');
       $this->user=$this->getUser();
    } 
    
    
}