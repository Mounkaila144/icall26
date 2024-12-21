<?php

class site_ajaxDashboardAction extends mfAction {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {    
        $messages=mfMessages::getInstance();
        $this->site=new Site($request->getPostParameter('Site'));        
        $this->getUser()->getStorage()->write(self::SITE_NAMESPACE,$this->site);     
       // echo time()." ".$this->site->getHost();
    }

}

