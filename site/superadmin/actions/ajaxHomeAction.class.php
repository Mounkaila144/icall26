<?php

class site_ajaxHomeAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
       $messages=mfMessages::getInstance(); 
       $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
       
    }

}

