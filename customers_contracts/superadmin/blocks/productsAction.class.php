<?php


class customers_contracts_productsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
        $this->contract=$this->getParameter('contract');   
       // foreach ($this->contract->getContractProducts() as $product)
       //         var_dump($product);
    } 
    
    
}

