<?php

class DomoprimeEnergyI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','energy_id','lang','created_at','updated_at');
    const table="t_domoprime_energy_i18n"; 
    protected static $foreignKeys=array('energy_id'=>'DomoprimeEnergy'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['energy_id']))
              return $this->loadByLangAndEnergyId((string)$parameters['lang'],(string)$parameters['energy_id']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           // Import
          if (isset($parameters['lang']) && isset($parameters['value']))          
              return $this->loadByLangAndValue($parameters['lang'],$parameters['value']); 
             if (isset($parameters['value']))
              return $this->loadByValue((string)$parameters['value']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }
      
   protected function loadByValue($value)
    {
         $this->set('value',$value);
         $db=mfSiteDatabase::getInstance()->setParameters(array('value'=>$value));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE UPPER(value)=UPPER('{value}');")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
     protected function loadByLangAndValue($lang,$value)
    {       
       $this->set('value',$value);
       $this->set('lang',strtolower($lang));      
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('value'=>$value,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND UPPER(value COLLATE UTF8_GENERAL_CI)=UPPER('{value}');")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
     protected function loadByLangAndEnergyId($lang,$energy_id)
    {
       $this->set('energy_id',$energy_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('energy_id'=>$energy_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND energy_id={energy_id};")
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
      $db->setParameters(array('value'=>$this->get('value'),'lang'=>$this->get('lang'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE value='{value}' AND lang='{lang}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
    }
    
     protected function hasSibbling()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("energy_id"=>$this->get('energy_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE energy_id={energy_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        if (parent::delete()===false)       
            return $this;
        if (!$this->hasSibbling())
            $this->getEnergy()->delete();
        return $this;
    }  
   
     function getEnergy()
    {
       if (!$this->_energy_id)
       {
          $this->_energy_id=new DomoprimeEnergy($this->get('energy_id'),$this->getSite());          
       }   
       return $this->_energy_id;
    }    
    
    function __toString() {
        return (string)$this->get('value');
    }
    
   
     static function getAll($site=null)
    {
        $values=new DomoprimeEnergyI18nCollection(null,$site);              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeEnergyI18n'))
        { 
            $values[$item->get('energy_id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
}
