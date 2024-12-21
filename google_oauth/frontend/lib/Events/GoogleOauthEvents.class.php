<?php

class GoogleOauthEvents {
                
     static function setSettingsForForm(mfEvent $event)
    {      
        if (!mfModule::isModuleInstalled('google_oauth'))
             return ;      
        $form=$event->getSubject();
        $form->addValidators(array(         
            'google_app_secret'=>new mfValidatorString(array('required'=>false)),                    
        ));
        $form->getComponents()->set("50_00_google_oauth","/google_oauth/settings");
    }
    
    
    
}
