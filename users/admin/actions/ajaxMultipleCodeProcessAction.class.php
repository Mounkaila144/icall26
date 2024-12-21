<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleUserProcessSelectionForm.class.php";


class users_ajaxMultipleCodeProcessAction extends mfAction {                  
        
    function execute(mfWebRequest $request) {
        
       if (!$this->getUser()->hasCredential([['superadmin','settings_user_multiple']]))
             $this->forwardTo401Action();   
        $messages = mfMessages::getInstance();                        
        $this->user=$this->getUser();
        $this->form=new MultipleUserProcessSelectionForm($this->getUser(),$request->getPostParameter('MultipleUserSelection'));        
        $this->form->bind($request->getPostParameter('MultipleUserSelection'));
        try
        {
            if ($this->form->isValid())  
            {                   
                $multiple=new UserMultipleProcess($this->form->getActions(),$this->form->getSelection(),$this->form->getValues(),$this->getUser());
                $multiple->activateCode();                            
                if ($multiple->hasMessages())
                    $messages->addInfos($multiple->getMessages());      
                if ($multiple->hasErrors())
                    $messages->addErrors($multiple->getErrors()); 
                 $messages->addInfo(__('Confirmation code by email is active for users.'));                  
            }  
            else
            {             
                $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
        $this->forward($this->getModuleName(), 'ajaxListPartial');
    }

}
