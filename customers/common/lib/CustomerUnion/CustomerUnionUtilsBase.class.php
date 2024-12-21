<?php


class CustomerUnionUtilsBase {
    
    static function getUnionForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerUnionI18n::getFieldsAndKeyWithTable()." FROM ".CustomerUnionI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerUnionI18n'))
        { 
            $values[$item->get('union_id')]=$item->get('value');
        }      
        return $values;
    }
    
  
    
}
