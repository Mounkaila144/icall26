<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerSectorNewForm.class.php";
 

class customers_ajaxNewSectorAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new CustomerSector(); // new object       
        $this->form = new CustomerSectorNewForm($request->getPostParameter('CustomerSector'));      
        if ($request->getPostParameter('CustomerSector'))
        {
            try 
            {
                $this->form->bind($request->getPostParameter('CustomerSector'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form->getValues());                   
                    if ($this->item->isExist())
                        throw new mfException (__("Sector already exists"));                                                       
                    $this->item->save();
                    $messages->addInfo(__("Sector [%s] has been created.",$this->item->get('name')));                   
                    $this->forward("customers","ajaxListPartialSector");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($request->getPostParameter('CustomerSector')); // repopulate       
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
