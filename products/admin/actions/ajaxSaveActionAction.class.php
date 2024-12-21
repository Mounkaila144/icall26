<?php

require_once dirname(__FILE__)."/../locales/Forms/ProductActionViewForm.class.php";
 

class products_ajaxSaveActionAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();        
        $this->user=$this->getUser();
        $this->item = new ProductAction($request->getPostParameter('ProductAction')); // new object       
        $this->form = new ProductActionViewForm($request->getPostParameter('ProductAction'),$this->user);  
        if (!$request->getPostParameter('ProductAction') || !$request->isMethod('POST'))
            return ;
        $this->form->bind($request->getPostParameter('ProductAction'));
        try
        {
             if ($this->form->isValid())
             {
                 $this->item->add($this->form->getValues()); // repopulate     
                 if ($this->item->isExist())
                     throw new mfException(__("Action already exists."));
                 $this->item->save();
                 $messages->addInfo(__("Action [%s] has been updated.",$this->item->get('action')));                   
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
