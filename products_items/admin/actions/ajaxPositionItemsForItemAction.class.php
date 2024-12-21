<?php


require_once dirname(__FILE__)."/../locales/Forms/ProductItemItemPositionsForm.class.php";

class products_items_ajaxPositionItemsForItemAction extends mfAction {


  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
         $this->item = new ProductItem($request->getPostParameter('ProductItem')); // new object    
         if ($this->item->isNotLoaded())
             return ;
         $this->form=new ProductItemItemPositionsForm($this->item,$request->getPostParameter('ProductItemItemPosition'));
         if (!$request->isMethod('POST') || !$request->getPostParameter('ProductItemItemPosition')) 
             return ;         
         $this->form->bind($request->getPostParameter('ProductItemItemPosition'));
         if ($this->form->isValid())
         {
             $this->item->updatePositions($this->form->getPositions());
             $messages->addInfo(__('Items positions have been updated.'));
             $request->addRequestParameter('product', $this->item->getProduct());
             $this->forward($this->getModuleName(), 'ajaxListPartialItemForProduct');
         }   
         else
         {
             $messages->addError(__('Form has some errors.'));
           //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
         } 
    }
    
}    