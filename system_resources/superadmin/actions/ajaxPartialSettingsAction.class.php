<?php


class system_resources_ajaxPartialSettingsAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                     
        $this->settings= new SystemResourceSettings();         
    }
    
}

