<?php


class CustomerMeetingStatusUtilsBase {
    
    static function getStatusForI18nSelect($site=null)
    {
        $cache= new mfCacheFile('meeting_state.multiple','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerMeetingStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingStatusI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return $values;
        }
        while ($item=$db->fetchObject('CustomerMeetingStatusI18n'))
        { 
            $values[$item->get('status_id')]=$item->get('value');
        }     
        $cache->register(serialize($values));
        return $values;
    }
    
    
    static function getStatusByValueForI18nSelect($site=null)
    {
        $values=array();              
        $lang=  mfcontext::getInstance()->getUser()->getLanguage();        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerMeetingStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingStatusI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerMeetingStatusI18n'))
        { 
            $values[$item->get('value')]=$item->get('value');
        }      
        return $values;
    }
  
    
}
