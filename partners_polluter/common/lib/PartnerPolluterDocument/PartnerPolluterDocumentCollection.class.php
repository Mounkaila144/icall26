<?php


class PartnerPolluterDocumentCollection extends mfObjectCollection2 {
    
    
    
     function __construct($data=null,$site=null) {
         parent::__construct($data,null, $site);
     }
     
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site); 
    }
    
    function implode($separator=",")
    {
        return implode($separator,$this->getKeys());
    }        
    
    
    
    function toXml()
    {
        $values=array();
        foreach ($this->collection as $item)
           $values[]=$item->toXML();
        return $values;
    }
}
