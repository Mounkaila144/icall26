<?php


class GroupCollection extends mfObjectCollection2 {
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions()." AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions()." AND application@@IN_APPLICATION@@;")
          ->makeSqlQuery($this->application,$this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuery($this->application,$this->site);   
    } 
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery($this->application,$this->site); 
    }
    
    
    protected function compareGroupI18n($a, $b) 
    {        
        if ($a->getI18n() == $b->getI18n()) 
                return 0;
        return ($a->getI18n() < $b->getI18n()) ? -1 : 1;
    }
    

    protected function sortGroups(&$groups)
    {
        uasort($groups,array($this,'compareGroupI18n'));        
    }
    
    function sortByNameI18n()
    {
        $this->sortGroups($this->collection);
        return $this;
    }
    
    function getNames()
    {
        if ($this->names===null)
        {
            $this->names=new mfArray();
            foreach ($this->collection as $item)
               $this->names[]=$item->get('name');
        }    
        return $this->names;
    }
    
}

