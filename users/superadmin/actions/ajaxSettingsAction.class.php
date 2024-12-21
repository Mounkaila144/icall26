<?php


class users_ajaxSettingsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");
        $this->user=$this->getUser();
        $this->settings= new UserSettings(null,$this->site);        
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
                  $this->settings->add($request->getPostParameter('Settings')); // Repopulate
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }
       }
    }
}

