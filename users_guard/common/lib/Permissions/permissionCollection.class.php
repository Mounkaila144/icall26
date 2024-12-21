<?php


class PermissionCollection extends mfObjectCollection2 {
    
   function __construct($data=null,$application=null,$site=null) {
       if ($data instanceof User)
       {
           $this->data=$data;
           return parent::__construct(null, $application,$site);     
       }    
        parent::__construct($data, $application,$site);     
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
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSqlQuery($this->application,$this->site); 
    }     
    
    function cmpNameI18n($a,$b)
    {       
      if ($a->getI18n()==$b->getI18n())
           return 0;
       if ($a->getI18n()<$b->getI18n())
           return -1;
       else
           return 1;     
    }
    
    function sortI18n()
    {                   
        uasort($this->collection,array($this,'cmpNameI18n'));     
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
    
     function getKeys()
    {
        return new mfArray(parent::getKeys());
    } 
    
     function push(mfObject2 $item)
    {
        if (!$item instanceof $this->class)       
          throw new mfDatabaseException("Database Collection Error : class object [".get_class($item)."] is invalid, class [".$this->class."] required.");    
        if (isset($this->collection[$item->getKey()]))
            return $this;
        $this[$item->getKey()]=$item;
        return $this;
    }
    
    
    function getAll()
    {
        if ($this->data instanceof User)
        {
           //   
        }                                
        return $this;
    }
    
    function hasPermissions($permissions)
    {
        
    }
    
    function removeDuplicate()
    {        
         $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT name FROM ".Permission::getTable().
                           " WHERE name IN('".$this->getNames()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
        if (!$db->getNumRows())
            return $this;
        while ($row=$db->fetchRow())  
        {
            unset($this->collection[$row[0]]);
        }
        return $this;
    }
}

