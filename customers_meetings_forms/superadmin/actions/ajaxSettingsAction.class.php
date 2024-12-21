<?php


class customers_meetings_forms_ajaxSettingsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
         $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");      
        $this->settings= new CustomerMeetingFormsSettings(null,$this->site);        
        $this->form=new CustomerMeetingFormsSettingsForm($this->site);  
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
                   // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                  $messages->addError(__('Form has somme errors.'));
                  $this->settings->add($request->getPostParameter('Settings')); // Repopulate
                }  
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }
       }
       if (!$this->settings->isAvailable())          
            $messages->addWarning(__("Schema/Data are not built."));
    }

}