<?php


class CustomerContractStatusUtilsBase {
  
    static function getStatusForI18nSelect($site=null)
    {
        $lang=  mfcontext::getInstance()->getUser()->getLanguage();
        $cache= new mfCacheFile('contract_status.multiple.select.'.md5($lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        static $values=array();      
        if ($values)
            return $values;                
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerContractStatusI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContractStatusI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
           $cache->register(serialize(array()));
           return $values;
        }
        while ($item=$db->fetchObject('CustomerContractStatusI18n'))
        { 
            $values[$item->get('status_id')]=$item->get('value');
        }              
        $cache->register(serialize($values));
        return $values;
    }
   
}

