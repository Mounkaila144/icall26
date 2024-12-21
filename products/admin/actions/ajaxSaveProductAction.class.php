<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductViewForm.class.php";
 

class products_ajaxSaveProductAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->item = new Product($request->getPostParameter('Product')); // new object    
        $this->user=$this->getUser();
        $this->form = new ProductViewForm($request->getPostParameter('Product'),$this->user);  
        if ($request->getPostParameter('Product') && $request->isMethod('POST'))
        {
            $this->form->bind($request->getPostParameter('Product'));
            try
            {
               // var_dump($this->form->getValues());
                 if ($this->form->isValid())
                 {
                     $this->item->add($this->form->getValues()); // repopulate     
                     if ($this->item->isExist())
                         throw new mfException(__("Product already exists."));
                     $this->item->save();
                     $messages->addInfo(__("Product [%s] has been updated.",$this->item->get('meta_title')));    
                     $this->getEventDispather()->notify(new mfEvent($this->item, 'product.update'));      
                     $this->forward("products","ajaxListPartialProduct");
                 }    
                 else
                 {
                      $messages->addError(__("Form has some errors."));   
                      $this->item->add($request->getPostParameter('Product')); // repopulate      
                    //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                 }    
             }
             catch (mfException $e)
             {
                 $messages->addError($e);   
             } 
            }    
        }

}
