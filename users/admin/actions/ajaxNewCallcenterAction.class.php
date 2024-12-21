<?php

require_once dirname(__FILE__)."/../locales/Forms/CallcenterNewForm.class.php";
 

class users_ajaxNewCallcenterAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->item = new Callcenter(); // new object       
        $this->form = new CallcenterNewForm($request->getPostParameter('Callcenter'));      
        if ($request->getPostParameter('Callcenter'))
        {
            try 
            {
                $this->form->bind($request->getPostParameter('Callcenter'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form->getValues());                   
                    if ($this->item->isExist())
                        throw new mfException (__("Callcenter already exists"));                                                       
                    $this->item->save();
                    $messages->addInfo(__("Callcenter [%s] has been created.",$this->item->get('name')));                   
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
