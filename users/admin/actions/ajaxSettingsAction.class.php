<?php


class users_ajaxSettingsAction extends mfAction {
    
 
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->settings= new UserSettings();        
        $this->form=new UserSettingsForm($this->getUser());          
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
                  $this->settings->add($request->getPostParameter('Settings')); // Repopulate
                  $messages->addError(__('Form has some errors.'));
              //    var_dump($this->form->getErrorSchema()->getErrorsMessage());
                }  
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }
       }       
    }
}

