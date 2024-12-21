<?php


class userCollection extends mfObjectCollection2 {
    
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
    
   /* function toJSON($fields=array())
    {
        $ret=array();
        foreach ($this->collection as $item)
        {
            $ret[]=$item->toArray($fields); 
        }    
        return $ret;
    }*/
    
    function getUsersWithEmail()
    {       
        if ($this->users_with_email===null)
        {    
            $this->users_with_email=new $this(null,$this->getSite());
            foreach ($this->collection as $item)
            {
                if ($item->get('email'))
                   $this->users_with_email[]=$item;
            }
        }
        return $this->users_with_email;
    }
    
    function getEmails()
    {
        if ($this->emails===null)
        {    
            $this->emails=new mfArray();
            foreach ($this->collection as $item)
            {
                if ($item->get('email'))
                   $this->emails[]=$item->get('email');
            }
        }
        return $this->emails;
    }
    
    function implode($separator=",")
    {
        $values=new mfArray();
        foreach ($this->collection as $item)
            $values[]=strtoupper ((string)$item);
        return $values->implode($separator);
    }
    
    function getKeys()
    {
        return new mfArray(parent::getKeys());
    }
    
    function getManagerAndTeams()
    {
        $values=new mfArray();  
        foreach ($this as $item)
        {
           $values[]=(string)$item.":".($item->hasTeams()?$item->getTeams()->getNames()->implode():__('No team'));
        }    
        return $values;
    }
}

