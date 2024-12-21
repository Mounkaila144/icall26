<?php

// www.ecosol28.net/admin/module/mobile/emulator/admin/Emulator

require_once dirname(__FILE__).'/../locales/Forms/EmulatorForm.class.php';

class site_emulator_ajaxEmulatorAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        try {
            $this->user=$this->getUser();
            $this->form = new EmulatorForm($this->user);
            
        } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }     
        $this->user_settings=  UserSettings::load();
    }

}
