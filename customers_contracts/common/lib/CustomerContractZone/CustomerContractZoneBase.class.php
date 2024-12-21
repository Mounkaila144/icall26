<?php


class CustomerContractZoneBase extends mfObject2 {
   
    protected static $fields=array('name','postcodes','max_contracts','is_active','created_at','updated_at');
    const table="t_customers_contracts_zone"; 
    
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
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%d';")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s"); 
       $this->is_active=isset($this->is_active)?$this->is_active:'NO';      
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
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE  name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
    function getPostCodes()
    {
        if ($this->isNotLoaded())
            return new mfArray();
        if ($this->_postcodes===null)
        {
            $this->_postcodes=new mfArray();
            foreach (explode(",",$this->get('postcodes')) as $value)
               $this->_postcodes[]=sprintf("%02d",$value);            
        }    
        return $this->_postcodes;
    }
    
    static function getActiveZonesForSelect($site=null){
        static $values=null;      
        if ($values)
            return $values;   
         $cache= new mfCacheFile('contract_zone.select.','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $values=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT name,id FROM ".CustomerContractZone::getTable().
                           " WHERE is_active='YES' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize($values));
           return $values;
        }
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }     
         $cache->register(serialize($values));
        return $values;
    }
    
    static function getActiveZones($site=null){       
         $cache= new mfCacheFile('contract_zone.list','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $values=new mfArray();        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".CustomerContractZone::getTable().
                           " WHERE is_active='YES' ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
         {
            $cache->register(serialize($values));
           return $values;
        }
        while ($item=$db->fetchObject('CustomerContractZone'))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }            
        $cache->register(serialize($values));
        return $values;
    }
    
    static function getItemsBySelection(mfArray $selection,$site=null)
    {           
        $values=new CustomerContractZoneCollection(null,$site);        
        $db=new mfSiteDatabase();
                $db->setParameters(array())
                ->setQuery("SELECT * FROM ".CustomerContractZone::getTable().
                           " WHERE id IN ('". $selection->implode("','")."');")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerContractZone'))
        { 
            $values[$item->get('id')]=$item->loaded()->setSite($site);
        }            
        return $values;
    }
    
    static function getZonesForSelect($site=null)
    {        
        $list=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".CustomerContractZone::getTable().                         
                           " ORDER BY name COLLATE UTF8_GENERAL_CI ASC ;"
                           )               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $list; 
        while ($item=$db->fetchObject('CustomerContractZone'))
        {
           $list[$item->get('id')]=$item->loaded();
        }            
        return $list;
    }   
    
    function __toString()
    {
        return (string)$this->get('name');
    }
    
    static function getZonesFromAddress( CustomerAddress $address)
    {                           
        $zones=new CustomerContractZoneCollection(null,$address->getSite());        
        $db=new mfSiteDatabase();
                $db->setParameters(array('dept'=>$address->getDept()))
                ->setQuery("SELECT * FROM ".CustomerContractZone::getTable().
                           " WHERE postcodes LIKE '%%{dept}%%' ;")
                ->makeSiteSqlQuery($address->getSite());
                //echo $db->getQuery();
        if (!$db->getNumRows())
            return $zones;
        while ($item=$db->fetchObject('CustomerContractZone'))
        { 
            $zones[$item->get('id')]=$item->loaded()->setSite($address->getSite());
        }    
        return $zones;
        
    }
    
    static function getNumberOfContractsInOpcAt(CustomerContract $contract,CustomerContractZoneCollection $zones)
    {                        
        $like=new mfArray();
        foreach ($zones->getPostcodes() as $postcode)        
             $like[]=" postcode LIKE '".$postcode."%%'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('opc_at'=>$contract->getOpcAtDate()->getDate()))              
                ->setQuery("SELECT count(".CustomerContract::getTableField('id').") as number_of_contracts ".
                            " FROM ".CustomerContract::getTable().               
                            " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                            " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                            " WHERE opc_at >= '{opc_at} 00:00:00' AND opc_at <= '{opc_at} 23:59:59' AND (".$like->implode(" OR ").")".
                            ";")
                ->makeSiteSqlQuery($contract->getSite()); 
      // echo $db->getQuery();
        $row=$db->fetchRow();        
        return intval($row[0]);
    }
    
    static function getNumberOfContractsInSavAt(CustomerContract $contract,CustomerContractZoneCollection $zones)
    {                        
        $like=new mfArray();
        foreach ($zones->getPostcodes() as $postcode)        
             $like[]=" postcode LIKE '".$postcode."%%'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('sav_at'=>$contract->getSavAtDate()->getDate()))              
                ->setQuery("SELECT count(".CustomerContract::getTableField('id').") as number_of_contracts ".
                            " FROM ".CustomerContract::getTable().               
                            " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                            " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').
                            " WHERE sav_at >= '{sav_at} 00:00:00' AND sav_at <= '{sav_at} 23:59:59' AND (".$like->implode(" OR ").")".
                            ";")
                ->makeSiteSqlQuery($contract->getSite()); 
      // echo $db->getQuery();
        $row=$db->fetchRow();        
        return intval($row[0]);
    }
    
     function save()
     {
         parent::save();
         mfCacheFile::removeCache('contract_zone','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('contract_zone','admin',$this->getSite());         
         return $this;
     }
}
