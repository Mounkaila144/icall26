<?php


class products_items_ajaxGetItemsForProductForSelectAction extends mfAction {


  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();             
        $this->product=new Product($request->getPostParameter('Product'));        
    }
    
}    
