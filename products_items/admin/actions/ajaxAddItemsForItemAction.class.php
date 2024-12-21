<?php

require_once dirname(__FILE__)."/../locales/Forms/AddItemsForItemForm.class.php";

class products_items_ajaxAddItemsForItemAction extends mfAction {


  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
         $this->item = new ProductItem($request->getPostParameter('ProductItem')); // new object    
         if ($this->item->isNotLoaded())
             return ;
         $this->form=new AddItemsForItemForm($this->item,$request->getPostParameter('AddProductItems'));
         if (!$request->isMethod('POST') || !$request->getPostParameter('AddProductItems')) 
             return ;         
         $this->form->bind($request->getPostParameter('AddProductItems'));
         if ($this->form->isValid())
         {
             $this->item->updateItems($this->form->getItems());
             $messages->addInfo(__('Items have been updated.'));
             $request->addRequestParameter('product', $this->item->getProduct());
             //$this->forward($this->getModuleName(), 'ajaxListPartialItemForProduct');
         }   
         else
         {
             $messages->addError(__('Form has some errors.'));
           //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
         }
    }
    
}    