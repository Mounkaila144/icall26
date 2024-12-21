<?php

class DomoprimeZoneBase extends mfObject2 {
     
    protected static $fields=array('code','region_id','dept','sector_id','created_at','updated_at');
    protected static $foreignKeys=array('region_id'=>'DomoprimeRegion',
                                        'sector_id'=>'DomoprimeSector'
                        ); // By default
    const table="t_domoprime_zone";     


    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);          
           if (isset($parameters['code']))
             return $this->loadbyCode((string)$parameters['code']);  
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);         
      }   
    }
 
    protected function loadByCode($code)
    {       
       $this->set('code',$code);      
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('code'=>intval($code)))              
            ->setQuery("SELECT * FROM ".self::getTable()." WHERE code='{code}';")
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
      $db->setParameters(array('id'=>$this->getKey(),'codee'=>$this->get('code')))
         ->setQuery("SELECT ".self::getTableField('id')." FROM ".self::getTable().                    
                    " WHERE code='{code}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
         
    }
    
     function getRegion()
    {
       if ($this->_region_id===null)
       {
          $this->_region_id=new DomoprimeRegion($this->get('region_id'),$this->getSite());          
       }   
       return $this->_region_id;
    }  
    
    
        function getSector()
    {
       if ($this->_sector_id===null)
       {
          $this->_sector_id=new DomoprimeSector($this->get('sector_id'),$this->getSite());          
       }   
       return $this->_sector_id;
    }  
    
    function getCode()
    {
        return sprintf("%02d",$this->get('code'));
    }
    
     static function getZoneForSelect($site=null)
    {
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".self::getTableFields(array('id','sector'))." FROM ".self::getTable().
                           " GROUP BY sector ".
                           " ORDER BY sector ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeZone'))
        { 
            $values[$item->get('id')]=$item->get('sector');
        }      
        return $values;
    }
    
    
     static function getZonesForSelect($site=null)
    {
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".self::getTableFields(array('id','code'))." FROM ".self::getTable().                           
                           " ORDER BY code+0 ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeZone'))
        { 
            $values[$item->get('id')]=$item->getCode();
        }      
        return $values;
    }
  
}
