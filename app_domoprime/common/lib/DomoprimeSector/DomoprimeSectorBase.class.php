<?php

class DomoprimeSectorBase extends mfObject2 {
     
    protected static $fields=array('name','created_at','updated_at');
    const table="t_domoprime_sector";     


    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);          
           if (isset($parameters['name']))
             return $this->loadbyName((string)$parameters['name']);  
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);         
      }   
    }
 
    protected function loadByName($name)
    {       
       $this->set('name',$name);      
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('name'=>$name))              
            ->setQuery("SELECT * FROM ".self::getTable()." WHERE name='{name}';")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->status=isset($this->status)?$this->status:"ACTIVE";
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {
      $key_condition=($this->getKey())?" AND ".self::getTableField('id')."!='{id}';":"";
      $db->setParameters(array('id'=>$this->getKey(),'name'=>$this->get('code')))
         ->setQuery("SELECT ".self::getTableField('id')." FROM ".self::getTable().                    
                    " WHERE name='{name}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
         
    }
    
    function __toString()
    {
        return (string)$this->get('name');
    }
    
     static function getSectorForSelect($site=null)
    {
        $values=array(); 
        $cache= new mfCacheFile('domoprime_sector.select','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " GROUP BY name ".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
            $cache->register(serialize(array()));
            return $values;
        }            
        while ($item=$db->fetchObject('DomoprimeSector'))
        { 
            $values[$item->get('id')]=$item->get('name');
        }
        $cache->register(serialize($values));
        return $values;
    }
    
     static function getSectorsForSelect($site=null)
    {
        $cache= new mfCacheFile('domoprime_sector.select2','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " GROUP BY name ".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows()){
            $cache->register(serialize(array()));
            return $values;
        }  
        while ($item=$db->fetchObject('DomoprimeSector'))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }    
        $cache->register(serialize($values));
        return $values;
    }
    
    
    static function getAll($site=null)
    {
        $values=new DomoprimeSectorCollection(null,$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().                        
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeSector'))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
    
    function save()
    {
        parent::save();
        mfCacheFile::removeCache('domoprime_sector','admin',$this->getSite());         
        return $this;
    }

     function delete()
    {
        parent::delete();
        mfCacheFile::removeCache('domoprime_sector','admin',$this->getSite());         
        return $this;
    }
  
}
