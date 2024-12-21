<?php

class UserTeamCollection extends mfObjectCollection2 {
    
    function __construct($data=null,$site=null) {
        parent::__construct($data, null, $site);
    }
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT ".$this->getTableKey().",user_id FROM ".$this->getTable().
                      " LEFT JOIN ".Group::getTable()." ON ".Group::getTableKey()."=group_id".
                      " WHERE ".$this->getWhereConditions()." AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site);     
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
    
    function getNames()
    {
        $names=new mfArray();
        foreach ($this->collection as $item)
           $names[]=$item->get('name');
        return $names;                
    }
    
    function getArrayKeys()
    {
        return new mfArray($this->getKeys());
    }
    
     function getKeys()
    {
        return new mfArray(parent::getKeys());
    }
    
    function getNamesForSelect()
    {
        $names=new mfArray();
        foreach ($this->collection as $item)
           $names[$item->get('id')]=$item->get('name');
        return $names;     
    }
}

