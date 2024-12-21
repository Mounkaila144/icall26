<?php


class customers_contracts_ajaxSettingsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();              
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");
        $this->settings= new CustomerContractSettings(null,$this->site);        
        $this->form=new CustomerContractSettingsForm($this->site);  
        if ($request->isMethod('POST') && $request->getPostParameter('Settings'))
        {
            try 
            {               
                $this->form->bind($request->getPostParameter('Settings'));
                if ($this->form->isValid())
                {
                    $this->settings->add($this->form->getValues());
                    if ($this->form->getValue('has_polluter'))
                    {                      
                        if (!mfModule::isModuleInstalled('partners_polluter',$this->site))
                        {
                           $module_manager=new ModuleManager('partners_polluter',$this->site);
                           $module_manager->add(array('is_active'=>'YES','is_available'=>'YES','status'=>'installed'));
                           $module_manager->getModule()->getInstaller()->upgrade();
                           $module_manager->save();
                        }    
                    }  
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

