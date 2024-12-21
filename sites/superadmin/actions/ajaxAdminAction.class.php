<?php

class sites_ajaxAdminAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {
        $messages=mfMessages::getInstance();  
        try 
        {
            $this->site_selected=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
            if (!$this->site_selected)
                $messages->addInfo(__("thanks to select a site")); 
            $this->sites = sitesAdmin::getlistSites();
        }
        catch (mfException $e)
        {
             $messages->addError($e);
        }
    }
}

