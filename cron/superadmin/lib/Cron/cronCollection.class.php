<?php


class cronCollection extends mfObjectCollection2 {
    
    protected function executeSelectQuery($db)
    {
//       $key=($this->method==self::LOADBYID)?$this->getClassKey():'name';
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin();    
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSqlQuerySuperAdmin();        
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuerySuperAdmin();      
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin();     
    }
}

