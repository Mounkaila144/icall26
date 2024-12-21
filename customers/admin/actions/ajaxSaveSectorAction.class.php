<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerSectorViewForm.class.php";
 

class customers_ajaxSaveSectorAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->item = new CustomerSector($request->getPostParameter('CustomerSector')); // new object       
        $this->form = new CustomerSectorViewForm();  
        if ($request->getPostParameter('CustomerSector') && $request->isMethod('POST'))
        {
            $this->form->bind($request->getPostParameter('CustomerSector'));
            try
            {
                 if ($this->form->isValid())
                 {
                     $this->item->add($this->form->getValues()); // repopulate     
                     if ($this->item->isExist())
                         throw new mfException(__("Sector already exists."));
                     $this->item->save();
                     $messages->addInfo(__("Sector [%s] has been updated.",$this->item->get('name')));                   
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
