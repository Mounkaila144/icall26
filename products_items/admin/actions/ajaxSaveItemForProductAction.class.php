<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductItemViewForm.class.php";
 

class products_items_ajaxSaveItemForProductAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();              
        $this->item = new ProductItem($request->getPostParameter('ProductItem')); // new object       
        $this->user=$this->getUser();
          $this->settings= new ProductItemSettings();       
        $this->form = new ProductItemViewForm($this->item,$request->getPostParameter('ProductItem'),$this->getUser());       
        if (!$request->getPostParameter('ProductItem') || $this->item->isNotLoaded())
            return ;       
        try 
        {           
            $this->form->bind($request->getPostParameter('ProductItem'));
            if ($this->form->isValid()) {
                $this->item->add($this->form->getValues());                   
               if ($this->item->isExist())
                    throw new mfException (__("Product item already exists"));                  
                $this->item->save();
                $messages->addInfo(__("Product item [%s] has been saved.",$this->item->get('reference')));  
                $request->addRequestParameter('product', $this->item->getProduct());
                $this->forward("products_items","ajaxListPartialItemForProduct");
            }
            else
            {
               $messages->addError(__("Form has some errors."));   
               $this->item->add($request->getPostParameter('ProductItem')); // repopulate       
            //   var_dump($this->form->getErrorSchema());
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }  

    }

}
