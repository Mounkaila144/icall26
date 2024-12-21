<?php

class CustomerMeetingForms extends CustomerMeetingFormsBase {
     
    const SITE_NAMESPACE = 'system/site';
   
    static function getDynamicFields()
    {        
        $site= mfcontext::getInstance()->getUser()->getStorage()->read(self::SITE_NAMESPACE);          
        $cache=self::getSchemaCache($site);    
        if ($cache->isExist())
            return unserialize($cache->getContent());
        return array();
    }
    
    
    
}
