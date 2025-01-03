<?php

/*
 * Generated by generator date : 25/03/13 16:38:07
 */
 
class moduleManagerAdminCollection extends mfObjectCollection2 {
    
    function __construct($data=null)
    {        
      parent::__construct($data,null);
    }
    
    protected function executeSelectQuery($db)
    {
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
        $db->setQuery("UPDATE ".$this->getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin();   
    }
}

