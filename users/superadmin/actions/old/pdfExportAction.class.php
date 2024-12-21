<?php


class users_pdfExportAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->users=userUtils::getUsers($this->site);
    }
}

