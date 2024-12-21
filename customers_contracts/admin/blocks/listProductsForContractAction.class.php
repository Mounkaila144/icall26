<?php

class customers_contracts_listProductsForContractActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                        
         $this->getEventDispather()->notify(new mfEvent($this->getParameter('contract'), 'contract.view.product.list'));  
    } 
    
    
}