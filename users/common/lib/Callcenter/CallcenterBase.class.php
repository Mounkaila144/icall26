<?php

class CallCenterBase extends mfObject2 {
     
    protected static $fields=array('name');
    const table="t_callcenter"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['name']))
             return $this->loadbyname((string)$parameters['name']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters); 
         return $this->loadbyName((string)$parameters);  
      }   
    }
    
    protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array($name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s';")
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
      
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
      
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
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
    
     static function getCallcenterForSelect($site=null)
    {
        $cache= new mfCacheFile('callcenters.meeting.select2','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $values=array();             
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return $values;
        }
        while ($item=$db->fetchObject('Callcenter'))
        { 
            $values[$item->get('id')]=strtoupper($item->get('name'));
        }      
        $cache->register(serialize($values));
        return $values;
    }
    
     static function getCallcentersForSelect(ConditionsQuery $where,$site=null)
    {       
        $cache= new mfCacheFile('callcenters.meeting.select.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".Callcenter::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').                         
                            $where->getWhere().
                           " GROUP BY ".CallCenter::getTableField('id').
                           " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('Callcenter'))
        {
           $items[$item->get('id')]=strtoupper($item->get('name'));
        }  
        $cache->register(serialize($items));
        return $items;
    }  
    
     static function getCallcenters(ConditionsQuery $where,$site=null)
    {       
        $cache= new mfCacheFile('callcenters.meeting.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setQuery("SELECT ".Callcenter::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').     
                           $where->getWhere().
                           " GROUP BY ".CallCenter::getTableField('id').
                           " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC ".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        }
        $items=array();
        while ($item=$db->fetchObject('CallCenter'))
        {
           if ($item->get('id'))
               $item->loaded();
           $items[$item->get('id')]= $item;
        }
        $cache->register(serialize($items));
        return $items;
    } 
    
    
     function toArrayForTransfer()
     {
         $values=parent::toArray(array('name'));        
         return $values;
     }
     
     
     static function createAndLoad(mfArray $utm_sources,$site=null)
     {
          $collection=new CallcenterCollection(null,$site);
         if ($utm_sources->isEmpty())
             return $collection;
         $values=new mfArray();
         foreach ($utm_sources as $utm_source)
           $values[]=  mfSiteDatabase::getInstance()->escape($utm_source); 
         // load
         $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CallCenter::getTable().
                           " WHERE name IN('".$values->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if ($db->getNumRows())
        {
            while ($item=$db->fetchObject('CallCenter'))
            { 
                $collection[$item->get('name')]=$item->loaded();
                $utm_sources->findAndRemove($item->get('name'));
            }      
            $collection->loaded();
        }
        // Create
        foreach ($utm_sources as $source)
        {
            $item=new CallCenter(null,$site);
            $item->set('name',$source);
            $collection[$source]=$item;
        }
        $collection->save();
        return $collection;   
     }        
     
      function save()
     {
         parent::save();
         mfCacheFile::removeCache('callcenters','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('callcenters','admin',$this->getSite());         
         return $this;
     }
}
