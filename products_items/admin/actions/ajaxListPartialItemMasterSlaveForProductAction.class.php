<?php


class products_items_ajaxListPartialItemMasterSlaveForProductAction extends mfAction{
    
       function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();     
        $this->settings= new ProductItemSettings();       
        $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;  
             
    }
}



 