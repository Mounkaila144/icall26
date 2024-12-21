<?php


class site_ajaxViewLogAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
     
    function execute(mfWebRequest $request)
    {        
         $messages = mfMessages::getInstance();          
         $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
         $this->forwardIf(!$this->site,"sites","Admin");        
         $this->log=new logFile($request->getPostParameter('name').".log");                         
    }
	
}

