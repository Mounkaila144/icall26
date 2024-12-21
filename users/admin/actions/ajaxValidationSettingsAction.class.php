<?php


class users_ajaxValidationSettingsAction extends mfAction {
    
        
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();   
          if (!$this->getUser()->hasCredential(array(array('superadmin','superadmin_settings_contract_validation'))))
            $this->forwardTo401Action();
        $this->settings= new UserValidationSettings();        
        $this->form=new UserValidationSettingsForm($this->getUser());                 
        if ($request->isMethod('POST') && $request->getPostParameter('Settings'))
        {
            try 
            {               
                $this->form->bind($request->getPostParameter('Settings'));
                if ($this->form->isValid())
                {
                    $this->settings->add($this->form->getValues());                    
                    $this->settings->save();
                    $messages->addInfo(__("Settings have been saved."));
                }
                else
                {
                  $messages->addError(__("Form has some errors."));
                  $this->settings->add($request->getPostParameter('Settings')); // Repopulate                   
                }  
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }
       }
    }
}

