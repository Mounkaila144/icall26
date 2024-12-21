<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleSelectionForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MultipleProcessSelectionForm.class.php";//


class products_items_ajaxMultipleUpdateProcessAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->form_multiple=new MultipleSelectionForm($this->getUser(),$request->getPostParameter('MultipleSelection'));                
        $this->form_multiple->bind($request->getPostParameter('MultipleSelection'));
        try
        {
            if ($this->form_multiple->isValid())
            {
               $this->form=new MultipleProcessSelectionForm($this->getUser());
               $this->form->setSelection($this->form_multiple->getSelection());              
            }  
            else
            {
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $messages->addError(__("Form has some errors."));
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
