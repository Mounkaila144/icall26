<?php

// http://www.ecosol16.net/admin/module/site/products/item/admin/SaveItemListMasterSlaveForProduct
require_once dirname(__FILE__)."/../locales/Forms/ProductItemsViewForm.class.php";

class products_items_ajaxSaveItemListMasterSlaveForProductAction extends mfAction {        
        
    function execute(mfWebRequest $request) {        
        $messages = mfMessages::getInstance();                              
        $this->item=new ProductItem($request->getPostParameter('ProductItem'));
        if ($this->item->isNotLoaded())
             return ;
        $this->form=new ProductItemsViewForm($this->item, $this->getUser(),$request->getPostParameter('ProductItems'));        
        if (!$request->isMethod('POST') || !$request->getPostParameter('ProductItems'))
            return ;
        $this->form->bind($request->getPostParameter('ProductItems')); 
        if ($this->form->isValid())
        {     
           $this->form->getSlaves()->save();
            $messages->addInfo(__("Items has been saved."));
            $request->addRequestParameter('ProductItem', $this->item);
            $request->addRequestParameter('product', $this->item->getProduct());
        }    
        else
        {               
            $messages->addError(__('Form has some errors.'));               
            //var_dump($this->form->getErrorSchema()->getErrorsMessage());  
            $this->item->add($request->getPostParameter('ProductItem')); // repopulate    
        }      
   }
}
