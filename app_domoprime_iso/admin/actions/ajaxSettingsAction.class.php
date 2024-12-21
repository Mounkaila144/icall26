<?php


class app_domoprime_iso_ajaxSettingsAction extends mfAction {
    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                     
        $this->settings= new DomoprimeIsoSettings();     
        $this->user=$this->getUser();
        $this->form=new DomoprimeIsoSettingsForm($this->getUser());  
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
               //   var_dump($this->form->getErrorSchema()->getErrorsMessage());
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

