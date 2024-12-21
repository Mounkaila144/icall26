<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductItemNewForm.class.php";
 

class products_items_ajaxNewItemMasterSlaveForProductAction extends mfAction {
     
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();              
        $this->user=$this->getUser();
        $this->settings= new ProductItemSettings();       
         $this->product=$request->getRequestParameter('product',new Product($request->getPostParameter('Product')));
        if ($this->product->isNotLoaded())
            return ;
        $this->form = new ProductItemNewForm($request->getPostParameter('ProductItem'),$this->getUser());     
        $this->item = new ProductItem(); // new object      
        if (!$request->getPostParameter('ProductItem'))
            return ;       
        try 
        {           
            $this->form->bind($request->getPostParameter('ProductItem'));
            if ($this->form->isValid()) {
                $this->item->add($this->form->getValues());                   
                if ($this->item->isExist())
                   throw new mfException (__("Product item already exists"));   
                $this->item->set('product_id',$this->product);
                $this->item->save();
                $messages->addInfo(__("Product item [%s] has been created.",$this->item->get('reference')));  
                $request->addRequestParameter('product', $this->product);
                $this->forward($this->getModuleName(),"ajaxListPartialItemMasterSlave");
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
