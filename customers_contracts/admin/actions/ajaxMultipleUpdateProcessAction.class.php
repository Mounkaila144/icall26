<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleContractSelectionForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MultipleContractProcessSelectionForm.class.php";


class customers_contracts_ajaxMultipleUpdateProcessAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->form_multiple=new MultipleContractSelectionForm($this->getUser(),$request->getPostParameter('MultipleContractSelection'));                
        $this->form_multiple->bind($request->getPostParameter('MultipleContractSelection'));
        try
        {
            if ($this->form_multiple->isValid())
            {
               $this->form=new MultipleContractProcessSelectionForm($this->getUser());
               $this->form->setSelection($this->form_multiple->getSelection());              
            }  
            else
            {
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $messages->addError(__("Form has some errors."));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }

}
