<?php

class siteEvents {
     
    const SITE_NAMESPACE = 'system/site';
    
    static function siteChange(mfEvent $event)
    {        
        $site=$event->getSubject();
        $action=$event->getParameters();
        if ($action=='delete')
        {
             $user=mfContext::getInstance()->getUser();
             if (($site_session=$user->getStorage()->read(self::SITE_NAMESPACE)) && $site_session->getHost()==$site->getHost())
                  $user->getStorage()->remove(self::SITE_NAMESPACE);                 
        }    
        mfContext::getInstance()->getSite()->clearHostCache($site); 
    }
    
    static function sitesChange(mfEvent $event)
    {
        $sites=$event->getSubject();
        $action=$event->getParameters();
        foreach ($sites as $site)
        {    
             siteUtils::deleteSite($site);
        }   
    }
    
    /* static function siteCreate(mfEvent $event)
    {
        $site=$event->getSubject();
        $action=$event->getParameters();
    }
    
    static function hostCreate(mfEvent $event)
    { 
        $site=$event->getSubject();
        $action=$event->getParameters();
    } */
    
    static function initializationExecute(mfEvent $event)
    {               
         $form=$event->getSubject();
                     
         SiteUtils::initializeSite($form->getSite());
    }
}

