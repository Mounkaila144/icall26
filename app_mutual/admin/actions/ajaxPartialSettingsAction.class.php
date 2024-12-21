<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualSettingsForm.class.php";

class app_mutual_ajaxPartialSettingsAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        
        $messages = mfMessages::getInstance();
        
        $this->form = new MutualSettingsForm();
        $this->settings = MutualSettings::load();
        
        if (!$request->getPostParameter('Settings'))
            return;
        try 
        {
            $this->form->bind($request->getPostParameter('Settings'));
            if ($this->form->isValid()) {
                
                $this->settings->add($this->form->getValues());
                $this->settings->save();
                $messages->addInfo(__("Settings has been saved"));
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
    }
}
  