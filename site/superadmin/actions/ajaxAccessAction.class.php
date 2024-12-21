<?php

class site_ajaxAccessAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
      //  $this->form = new siteChangeAccessForm(); // Just to get token
    }

}

