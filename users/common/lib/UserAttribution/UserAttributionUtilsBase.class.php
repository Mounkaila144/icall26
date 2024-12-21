<?php


class UserAttributionBaseUtils {
    
    static function getFieldValuesForI18nSelect($name,$lang,$site=null)
    {
        $values=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang,"name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".UserAttributionI18n::getKeyName()." FROM ".UserAttributionI18n::getTable()." WHERE lang='{lang}' ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[UserAttributionI18n::getKeyName()]]=$value[$name];
        }      
        return $values;
    }
    
    static function getUsersByAttributionForSelect($attribution,$site=null)
    {
        $values=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("attribution"=>$attribution))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserAttributions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserAttributions::getOuterForJoin('attribution_id').
                           " WHERE ".UserAttribution::getTableField('name')."='{atribution}' ORDER BY ".User::getTableField('lastname')." ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('User'))
        {            
            $values[$item->get('id')]=(string)$item;
        }      
        return $values;
    }
    
    
    static function getAttributionsForI18nSelect($site=null)
    {
        $values=array();          
        $lang=  mfcontext::getInstance()->getUser()->getCountry();      
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".UserAttributionI18n::getFieldsAndKeyWithTable()." FROM ".UserAttributionI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('UserAttributionI18n'))
        { 
            $values[$item->get('attribution_id')]=$item->get('value');
        }      
        return $values;
    }
}
