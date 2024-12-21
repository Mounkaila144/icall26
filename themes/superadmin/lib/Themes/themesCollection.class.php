<?php


class ThemesCollection extends ThemeCollectionCore {
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin($this->application);    
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSqlQuerySuperAdmin($this->application);  
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuerySuperAdmin($this->application);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuerySuperAdmin($this->application);  
    }
    
 
}

