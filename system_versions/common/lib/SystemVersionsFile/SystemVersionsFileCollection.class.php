<?php

	
class SystemVersionsFileCollection extends mfObjectCollection2 {
    
    public function __construct($data=null) {
        parent::__construct($data);
    }
    
    protected function executeSelectQuery($db)
    {
        $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery();   
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setParameters()
           ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery();  
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuery();   
    }            
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery(); 
    }
    
    function getItemByIndex($index,$default=null)
    {
        return isset($this->collection[$index])?$this->collection[$index]:$default;
    }
}
