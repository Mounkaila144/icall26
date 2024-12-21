<?php


class dashboard_preferencesViewAction extends mfAction {
    
  
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();       
       // $this->favicons=dashboardUtils::getFavicons();  
        
         $this->preferences= new PreferencesSettings(); 
        
    }
}

