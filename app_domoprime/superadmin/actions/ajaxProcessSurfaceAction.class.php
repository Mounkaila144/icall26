<?php



class app_domoprime_ajaxSettingsAction extends mfAction {
	
    
   
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {           
      $messages = mfMessages::getInstance();   
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);               
      $this->forwardIf(!$this->site,"sites","Admin"); 
     
    } 
}

