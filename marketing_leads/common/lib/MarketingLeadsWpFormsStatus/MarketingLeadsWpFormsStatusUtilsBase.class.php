<?php


class MarketingLeadsWpFormsStatusUtilsBase {
    
    static function getStatusForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".MarketingLeadsStatusI18n::getFieldsAndKeyWithTable()." FROM ".MarketingLeadsStatusI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('MarketingLeadsStatusI18n'))
        { 
            $values[$item->get('status_id')]=$item->get('value');
        }      
        return $values;
    }
    
    
    static function getStatusByValueForI18nSelect($site=null)
    {
        $values=array();              
        $lang=  mfcontext::getInstance()->getUser()->getLanguage();        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".MarketingLeadsStatusI18n::getFieldsAndKeyWithTable()." FROM ".MarketingLeadsStatusI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('MarketingLeadsStatusI18n'))
        { 
            $values[$item->get('value')]=$item->get('value');
        }      
        return $values;
    }
  
    
}
