<?php

require_once dirname(__FILE__)."/../locales/Forms/CallcenterViewForm.class.php";
 

class users_ajaxSaveCallcenterAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();       
        $this->item = new Callcenter($request->getPostParameter('Callcenter')); // new object       
        $this->form = new CallcenterViewForm();  
        if ($request->getPostParameter('Callcenter') && $request->isMethod('POST'))
        {
            $this->form->bind($request->getPostParameter('Callcenter'));
            try
            {
                 if ($this->form->isValid())
                 {
                     $this->item->add($this->form->getValues()); // repopulate     
                     if ($this->item->isExist())
                         throw new mfException(__("Callcenter already exists."));
                     $this->item->save();
                     $messages->addInfo(__("Callcenter [%s] has been updated.",$this->item->get('name')));                   
                     $this->forward("users","ajaxListPartialCallcenter");
                 }    
                 else
                 {
                      $messages->addError(__("Form has some errors."));   
                      $this->item->add($request->getPostParameter('Callcenter')); // repopulate      
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
