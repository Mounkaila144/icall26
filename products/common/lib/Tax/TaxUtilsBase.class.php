<?php


class TaxUtilsBase {
  
    
    static function getTaxesForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Tax::getTable()." ORDER BY rate ASC;")               
                ->makeSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $list=array();
        while ($tax=$db->fetchObject('tax'))
        {
           $list[$tax->get('id')]=  format_pourcentage($tax->get('rate'));
        }     
        return $list;
    } 
    
    static function getTaxes($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Tax::getTable()." ORDER BY rate ASC;")               
                ->makeSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $list=array();
        while ($tax=$db->fetchObject('tax'))
        {
           $list[$tax->get('id')]=  $tax->loaded()->setSite($site);
        }     
        return $list;
    } 
    
    
    static function getCollectionById($taxes,$site=null)
    {
        $collection=new TaxCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Tax::getTable().
                           " WHERE id IN('".implode("','",$taxes)."')".
                           ";")               
                ->makeSqlQuery($site); 
        if (!$db->getNumRows())
            return $collection;        
        while ($tax=$db->fetchObject('tax'))
        {
           $collection[$tax->get('id')]=  $tax->setSite($site)->loaded();
        }     
        return $collection;
    } 
    
   
}

