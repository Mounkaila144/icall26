<?php
require_once dirname(__FILE__).'/../locales/Forms/ServerServicesSettingsForm.class.php';

class server_services_ajaxSettingsAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {     
        $messages = mfMessages::getInstance();                     
        $this->settings= new ServerServicesSettings();        
        $this->form=new ServerServicesSettingsForm();          
        if ($request->isMethod('POST') && $request->getPostParameter('Settings'))
        {
            try 
            {               
                $this->form->bind($request->getPostParameter('Settings'));
                if ($this->form->isValid())
                {
                  //  var_dump($this->form->getValues());
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
