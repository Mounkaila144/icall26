<?php

class MutualPartnerCollection extends mfObjectCollection2 {
    
    
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
    
    function getMutualNamesForSelect()
    {
        $values = new mfArray();
        
        foreach ($this->collection as $mutual)
        {
            $values[$mutual->get('id')] = $mutual->get('name');
        }
        
        return $values->toArray();  // return $values;
    }
    
    function toJsonForForm()
    {
        $mutuals_json = new mfArray();
        foreach($this->collection as $mutual)
        {
            $mutuals_json[$mutual->get('id')] = array('mutual'=>$mutual->toArray2(array('id','name','in_select'))->toArray(), 'Products'=>$mutual->getProducts()->toArrayForJsonForForm());
        }
        
        return $mutuals_json->toJson();
    }
    
    function isInSelect($mutual)
    {
        $this->collection[$mutual]->set('in_select','YES');
    }
    
}
