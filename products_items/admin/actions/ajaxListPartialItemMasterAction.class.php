<?php


class products_items_ajaxListPartialItemMasterAction extends mfAction{
    
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->settings= new ProductItemSettings();       
        $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;  
             
    }
}



 