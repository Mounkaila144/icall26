<?php

class MutualProductCollection extends mfObjectCollection2 {
    
    
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
    
    function toArrayForJsonForForm()
    {
        $values = new mfArray();
        foreach($this->collection as $product)
        {
            $values[$product->get('id')] = $product->toArray(array('id','name','in_select'));
        }
        
        return $values->toArray();
    }
    
    function isInSelect($product)
    {
        $this->collection[$product]->set('in_select','YES');
    }
}
