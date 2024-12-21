<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportSettingsForm.class.php";

class customers_meetings_imports_ajaxSettingsAction extends mfAction {
    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                     
        $this->settings= new CustomerMeetingImportSettings();        
        $this->form=new CustomerMeetingImportSettingsForm();  
        if (!$request->isMethod('POST') || !$request->getPostParameter('Settings'))
            return ;
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
              $this->settings->add($request->getPostParameter('Settings')); // Repopulate
        }
        catch (mfException $e)
        {
          $messages->addError($e);
        }       
    }
}

