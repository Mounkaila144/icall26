<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductItemsNewForm.class.php"; 

class products_items_ajaxNewItemListMasterSlaveForProductAction extends mfAction {
                 
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance(); 
        $this->product=$request->getRequestParameter('Product',new Product($request->getPostParameter('Product')));       
        $this->form = new ProductItemsNewForm($this->product,$this->getUser(),$request->getPostParameter('ProductItems'));        
        if ($this->product->isNotLoaded() || !$request->isMethod('POST') || !$request->getPostParameter('ProductItems'))
            return;
           $this->form->bind($request->getPostParameter('ProductItems')); 
           if ($this->form->isValid())
           {  
                if ($this->form->getMaster()->isExist())
                   throw new mfException (__("Product item already exists"));   
                $this->form->getSlaves()->create();                                                
                $messages->addInfo(__("Items has been saved."));
           }    
           else
           {               
               $messages->addError(__('Form has some errors.'));               
           }
          

    }

}
