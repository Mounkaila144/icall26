<?php

class DomoprimeSubventionTypeBase extends mfObject3 {
     
    protected static $fields=array('name','commercial','created_at','updated_at');
    const table="t_domoprime_subvention_type";     


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
    
   
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->status=isset($this->status)?$this->status:"ACTIVE";
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
   
    
    protected function executeIsExistQuery($db)    
    {
      $key_condition=($this->getKey())?" AND ".self::getTableField('id')."!='{id}';":"";
      $db->setParameters(array('id'=>$this->getKey(),'name'=>$this->get('name')))
         ->setQuery("SELECT ".self::getTableField('id')." FROM ".self::getTable().                    
                    " WHERE name='{name}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
         
    }
    
    function __toString()
    {
        return (string)$this->get('name');
    }
    
     static function getTypeForSelect($site=null)
    {
        $values=new mfArray();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " GROUP BY name ".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject(__CLASS__))
        { 
            $values[$item->get('id')]=ucfirst($item->get('name'));
        }      
        return $values;
    }
    
     static function getTypesForSelect($site=null)
    {
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " GROUP BY name ".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject(__CLASS__))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }      
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
        while ($item=$db->fetchObject(__CLASS__))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
  
}
