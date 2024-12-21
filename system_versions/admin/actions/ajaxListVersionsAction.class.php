<?php

class system_versions_ajaxListVersionsAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();
        try
        {            
            $this->system_version = new SystemVersionsFile();                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }
    
}
