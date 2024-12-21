<?php

class languageEvents {
        
    static function languageChange(mfEvent $event)
    {
        $language=$event->getSubject();      
        mfCacheFile::removeCache('languages',$language->get('application'));        
    }
    
    static function languagesChange(mfEvent $event)
    {
        $languages=$event->getSubject();       
        mfCacheFile::removeCache('languages',$languages->getApplication());
    }
}

