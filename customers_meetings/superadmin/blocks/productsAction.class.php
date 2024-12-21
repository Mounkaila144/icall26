<?php


class customers_meetings_productsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
        $this->meeting=$this->getParameter('meeting');          
       // var_dump($this->meeting->getMeetingProductsActive());
       // foreach ($this->contract->getContractProducts() as $product)
       //         var_dump($product);
    } 
    
    
}

