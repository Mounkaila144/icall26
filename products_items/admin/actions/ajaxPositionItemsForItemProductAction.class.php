<?php


require_once dirname(__FILE__)."/../locales/Forms/ProductItemPositionsForm.class.php";

class products_items_ajaxPositionItemsForItemProductAction extends mfAction {


  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();         
         $this->product = new Product($request->getPostParameter('Product')); // new object    
         if ($this->product->isNotLoaded())
             return ;
          $this->form=new ProductItemPositionsForm($this->product,$request->getPostParameter('ProductItemPosition'));
         if (!$request->isMethod('POST') || !$request->getPostParameter('ProductItemPosition')) 
             return ;         
         $this->form->bind($request->getPostParameter('ProductItemPosition'));
         if ($this->form->isValid())
         {
             $this->product->updatePositions($this->form->getPositions());
             $messages->addInfo(__('Items positions have been updated.'));
             $request->addRequestParameter('product', $this->product);
             $this->forward($this->getModuleName(), 'ajaxListPartialItemMasterSlave');
         }   
         else
         {
             $messages->addError(__('Form has some errors.'));
           //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
         }  
    }
    
}    