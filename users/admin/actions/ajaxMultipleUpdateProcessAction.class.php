<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleUserSelectionForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MultipleUserProcessSelectionForm.class.php";


class users_ajaxMultipleUpdateProcessAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {      
        if (!$this->getUser()->hasCredential([['superadmin','settings_user_multiple']]))
             $this->forwardTo401Action();           
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->form_multiple=new MultipleUserSelectionForm($this->getUser(),$request->getPostParameter('MultipleUserSelection'));                
        $this->form_multiple->bind($request->getPostParameter('MultipleUserSelection'));
        try
        {
            if ($this->form_multiple->isValid())
            {
               $this->form=new MultipleUserProcessSelectionForm($this->getUser());
               $this->form->setSelection($this->form_multiple->getSelection());              
            }  
            else
            {
             //    var_dump($this->form_multiple->getErrorSchema()->getErrorsMessage());
                $messages->addError(__("Form has some errors."));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }

}
