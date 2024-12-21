<?php

class marketing_leads_ajaxSettingsAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                      
        $this->settings = new MarketingLeadsWpSettings();        
        $this->form = new MarketingLeadsWpSettingsForm();  
        if (!$request->isMethod('POST') || !$request->getPostParameter('Settings'))
            return;
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

