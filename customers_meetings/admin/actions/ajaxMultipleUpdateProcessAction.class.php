<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleMeetingSelectionForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MultipleMeetingProcessSelectionForm.class.php";


class customers_meetings_ajaxMultipleUpdateProcessAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->form_multiple=new MultipleMeetingSelectionForm($this->getUser(),$request->getPostParameter('MultipleMeetingSelection'));        
        $this->form_multiple->bind($request->getPostParameter('MultipleMeetingSelection'));
        try
        {
            if ($this->form_multiple->isValid())
            {
               $this->form=new MultipleMeetingProcessSelectionForm($this->getUser());
               $this->form->setSelection($this->form_multiple->getSelection());
               // var_dump($this->form_multiple->getSelection());          
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
