<?php

class DomoprimeRegionBase extends mfObject2 {
     
    protected static $fields=array('name');    
    const table="t_domoprime_region";     


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
    
   
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
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
    
   /* protected function executeIsExistQuery($db)    
    {
      $key_condition=($this->getKey())?" AND ".self::getTableField('id')."!='{id}';":"";
      $db->setParameters(array('id'=>$this->getKey(),'codee'=>$this->get('code')))
         ->setQuery("SELECT ".self::getTableField('id')." FROM ".self::getTable().                    
                    " WHERE code='{code}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
         
    }*/
    
    static function getRegionForSelect($site=null)
    {
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".self::getTableFields(array('id','name'))." FROM ".self::getTable().
                           " GROUP BY name ".
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeRegion'))
        { 
            $values[$item->get('id')]=$item->get('name');
        }      
        return $values;
    }
  
    
    static function getAll($site=null)
    {
        $values=new DomoprimeRegionCollection(null,$site);              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".self::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeRegion'))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
}
