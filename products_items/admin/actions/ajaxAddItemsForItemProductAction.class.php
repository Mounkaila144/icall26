<?php

require_once dirname(__FILE__)."/../locales/Forms/AddItemsForItemProductForm.class.php";

class products_items_ajaxAddItemsForItemProductAction extends mfAction {
  
    function execute(mfWebRequest $request) {
        
         $messages = mfMessages::getInstance();     
         $this->item = new ProductItem($request->getPostParameter('ProductItem')); // new object    
         $this->callback=$request->getPostParameter('Action');
        // var_dump($this->callback);
         if ($this->item->isNotLoaded())
             return ;
         $this->form=new AddItemsForItemProductForm($this->item,$request->getPostParameter('AddProductItems'));
         if (!$request->isMethod('POST') || !$request->getPostParameter('AddProductItems')) 
             return ;         
         $this->form->bind($request->getPostParameter('AddProductItems'));
         if ($this->form->isValid())
         {
             $this->item->updateItems($this->form->getItems());
             $messages->addInfo(__('Items have been updated.'));
             $request->addRequestParameter('product', $this->item->getProduct());
             $request->addRequestParameter('ProductItem', $this->item);
             $this->forward($this->getModuleName(), 'ajax'.$this->callback);
         }   
         else
         {
             $messages->addError(__('Form has some errors.'));
            // var_dump($this->form->getErrorSchema()->getErrorsMessage());
         }
    }
    
}    