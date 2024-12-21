<?php


class customers_contracts_ajaxSettingsAction extends mfAction {
    
        
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                      
        $this->settings= new CustomerContractSettings();        
        $this->form=new CustomerContractSettingsForm($this->getUser());                 
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

