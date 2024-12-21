<?php


class DomoprimeCumacEngineSettingBase extends mfObject2 {
     
    protected static $fields=array('name','engine', 
                                   'created_at','updated_at'
                                );
    const table="t_domoprime_iso_cumac_engine_setting"; 
     protected static $foreignKeys=array( );
     
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);         
          return $this->add($parameters); 
      }   
      else
      {                
          if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters); 
      }   
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
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    } 
    
    function __toString() {
        return (string)ucfirst($this->get('name'));
    }
    
    function getNameI18n()
    {
        return new mfString(__($this->get('name'),[],'messages','app_domoprime_multi'));
    }
    
    function getEngine()
    {            
        return "Domoprime".ucfirst(strtolower($this->get('engine')))."CumacContractEngine";
    }
    
    function getCalculationEngine()
    {            
        return "Domoprime".ucfirst(strtolower($this->get('engine')))."CalculationEngine";
    }
    
     function getDocumentEngine()
    {            
        return "Domoprime".ucfirst(strtolower($this->get('engine','Default')))."DocumentWorkEngine";
    }
    
     function save()
     {
         parent::save();
         mfCacheFile::removeCache('cumac_engine_settings','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('cumac_engine_settings','admin',$this->getSite());         
         return $this;
     }
  
    static function getEnginesForSelect($site=null)       
    {       
        $cache= new mfCacheFile('cumac_engine_settings','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
         $values=new mfArray();  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().                             
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
             $cache->register(serialize($values));
            return $values;
        }
        while ($item=$db->fetchObject(__CLASS__))
        { 
            $values[$item->get('id')]=$item->loaded();
        }  
         $cache->register(serialize($values));
        return $values;                
    }        
}

