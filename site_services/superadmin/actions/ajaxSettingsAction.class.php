<?php
require_once dirname(__FILE__).'/../locales/Forms/SiteServicesSettingsForm.class.php';

class site_services_ajaxSettingsAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();                     
        $this->settings= new SiteServicesSettings();        
        $this->form=new SiteServicesSettingsForm();          
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
                  $this->settings->add($request->getPostParameter('Settings')); // Repopulate
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }
       }
    }

}
