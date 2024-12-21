<?php

class DomoprimeClassI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','class_id','lang','created_at','updated_at');
    const table="t_domoprime_class_i18n"; 
    protected static $foreignKeys=array('class_id'=>'DomoprimeClass'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['class_id']))
              return $this->loadByLangAndClassId((string)$parameters['lang'],(string)$parameters['class_id']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           // Import
          if (isset($parameters['lang']) && isset($parameters['value']))          
              return $this->loadByLangAndValue($parameters['lang'],$parameters['value']);  
           if (isset($parameters['value']))          
              return $this->loadByValue($parameters['value']);  
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
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('value'=>$value))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE UPPER(value)=UPPER('{value}') LIMIT 0,1;")
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
                       " WHERE lang='{lang}' AND UPPER(value)=UPPER('{value}');")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
     protected function loadByLangAndClassId($lang,$class_id)
    {       
       $this->set('class_id',$class_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('class_id'=>$class_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND class_id={class_id};")
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
            ->setParameters(array("class_id"=>$this->get('class_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE class_id={class_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        if (parent::delete()===false)       
            return $this;
        if (!$this->hasSibbling())
            $this->getClass()->delete();
        return $this;
    }  
   
     function getClass()
    {
       if (!$this->_class_id)
       {
          $this->_class_id=new DomoprimeClass($this->get('class_id'),$this->getSite());          
       }   
       return $this->_class_id;
    }    
    
    function __toString() {
        return (string)$this->get('value');
    }
    
   
    static function getAll($site=null)
    {
        $cache= new mfCacheFile('domoprime_class.all','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());   
        $values=new DomoprimeClassI18nCollection(null,$site);              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
         {
            $cache->register(serialize(array()));
            return $values;
        }   
        while ($item=$db->fetchObject('DomoprimeClassI18n'))
        { 
            $values[$item->get('class_id')]=$item->loaded()->setSite($site);
        }   
        $cache->register(serialize($values));
        return $values;
    }
}
