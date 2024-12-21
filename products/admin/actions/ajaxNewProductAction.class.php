<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductNewForm.class.php";
 

class products_ajaxNewProductAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new Product(); // new object      
        $this->user=$this->getUser();
        $this->form = new ProductNewForm($request->getPostParameter('Product'),$this->user);      
        if ($request->getPostParameter('Product'))
        {
            try 
            {
                $this->form->bind($request->getPostParameter('Product'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form->getValues());                   
                    if ($this->item->isExist())
                        throw new mfException (__("Product already exists"));                                                       
                    $this->item->save();
                    $messages->addInfo(__("Product [%s] has been created.",$this->item->get('meta_title')));      
                     $this->getEventDispather()->notify(new mfEvent($this->item, 'product.new'));      
                    $this->forward("products","ajaxListPartialProduct");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($request->getPostParameter('Product')); // repopulate       
                //   var_dump($this->form->getErrorSchema());
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }

}
