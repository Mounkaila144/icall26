<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductActionNewForm.class.php";
 

class products_ajaxNewActionAction extends mfAction {
    

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->item = new ProductAction(null,$this->site); // new object       
        $this->form = new ProductActionNewForm($request->getPostParameter('ProductAction'),$this->user);      
        if (!$request->getPostParameter('ProductAction'))
            return ;       
        try 
        {
            $this->form->bind($request->getPostParameter('ProductAction'));
            if ($this->form->isValid()) {
                $this->item->add($this->form->getValues());                   
                if ($this->item->isExist())
                    throw new mfException (__("Product action already exists"));                                                       
                $this->item->save();
                $messages->addInfo(__("Action [%s] has been created.",$this->item->get('action')));                   
                $this->forward("products","ajaxListPartialAction");
            }
            else
            {
               $messages->addError(__("Form has some errors."));   
               $this->item->add($this->form->getDefaults()); // repopulate       
            //   var_dump($this->form->getErrorSchema());
            }    
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }            
    }

}
