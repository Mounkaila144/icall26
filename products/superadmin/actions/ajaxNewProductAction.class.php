<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductNewForm.class.php";
 

class products_ajaxNewProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->user=$this->getUser();
        $this->item = new Product(null,$this->site); // new object       
        $this->form = new ProductNewForm($request->getPostParameter('Product'),$this->user,$this->site);      
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
