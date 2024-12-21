<?php

class languageCollection extends  orderedObjectCollection {
    
    protected function executeLastPositionQuery($db)
    {
        $db->setQuery("SELECT max(position) FROM ".$this->getTable()." WHERE application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site); 
    }
        
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
        $db->setQuery("UPDATE ".$this->getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery($this->application,$this->site); 
    }
    
    protected function executeUpdatePositionQuery($position,$db)
    {
        $db->setParameter('position',$position)
           ->setQuery("UPDATE ".$this->getTable()." SET position=( SELECT @position:=@position+1 ) WHERE position > {position} AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site); 
    }
    
    /* *************** M E T H O D S *******************************************/
    
    function sortByCountry()
    {
        usort ($this->collection , array($this,"cmp_sort"));
    }
    
    function cmp_sort($a,$b)
    {
        $a1=$a->getI18nLanguage();
        $b1=$b->getI18nLanguage();
        if ($a1 == $b1) {
            return 0;
        }
        return ($a1 > $b1) ? +1 : -1;
    }
}

