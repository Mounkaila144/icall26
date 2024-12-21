<?php


class system_ajaxPartialSettingsAction extends mfAction {
    
        
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                      
        $this->settings= new SystemSettings();    
      //  var_dump($this->settings->get('holidays'));
        $this->form=new SystemSettingsForm($request->getPostParameter('Settings'));  
        if ($request->isMethod('POST') && $request->getPostParameter('Settings'))
        {
            try 
            {               
                $this->form->bind($request->getPostParameter('Settings'));
                if ($this->form->isValid())
                {
                    $this->settings->add($this->form->getValues());
                   // var_dump($this->form->getValues());
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

