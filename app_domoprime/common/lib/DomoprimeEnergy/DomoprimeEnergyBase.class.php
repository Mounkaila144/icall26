<?php

class DomoprimeEnergyBase extends mfObject2 {
     
    protected static $fields=array('name','type');
    const table="t_domoprime_energy"; 
    
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
    
     public function hasI18n($lang=null)
     {
        return (boolean)$this->getI18n($lang);
     } 
     
 
     public function setI18n($i18n)
     {
         $this->i18n=$i18n;
         return $this;
     } 
     
     public function getI18n($lang=null)
     {      
         if ($this->i18n===null)
         {
              if ($lang==null)
                  $lang=  mfcontext::getInstance()->getUser()->getCountry();
             $this->i18n=new DomoprimeEnergyI18n(array('lang'=>$lang,"energy_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
       
     
    static function getEnergyForI18nSelect($site=null)
    {
        static $values=null;
        
        if ($values)  return $values;
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeEnergyI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeEnergyI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeEnergyI18n'))
        { 
            $values[$item->get('energy_id')]=$item->get('value');
        }      
        return $values;
    }
    
    
     static function getEnergyIDs($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT id FROM ".DomoprimeEnergy::getTable().
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['id'];
        }      
        return $values;
    }
    
      static function getEnergyI18nForSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $cache= new mfCacheFile('domoprime_energy.select.'.md5($lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeEnergyI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeEnergyI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return $values;
        }
        while ($item=$db->fetchObject('DomoprimeEnergyI18n'))
        { 
            $values[$item->get('energy_id')]=$item->loaded()->setSite($site);
        }     
        $cache->register(serialize($values));
        return $values;
    }
    
     static function getEnergyI18nListForSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $cache= new mfCacheFile('domoprime_energy.list.select.'.md5($lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeEnergyI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeEnergyI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return $values;
        }
        while ($item=$db->fetchObject('DomoprimeEnergyI18n'))
        { 
            $values[$item->get('energy_id')]=(string)$item;
        }  
        $cache->register(serialize($values));
        return $values;
    }
    
    static function getEnergiesByNameI18n($site=null)
    {
        $values=array();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>mfcontext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".DomoprimeEnergyI18n::getTableFields(array('energy_id','value'))." FROM ".DomoprimeEnergyI18n::getTable().
                           " WHERE value!=''".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
      //  echo $db->getQuery();
        while ($row=$db->fetchArray())
        {          
            $values[$row['value']]=$row['energy_id'];
        }             
        return $values;
    }
    
    
     static function getMinusEnergiesByNameI18n($site=null)
    {
        $values=new mfArray();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>mfcontext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".DomoprimeEnergyI18n::getTableFields(array('energy_id','value'))." FROM ".DomoprimeEnergyI18n::getTable().
                           " WHERE value!=''".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
      //  echo $db->getQuery();
        while ($row=$db->fetchArray())
        {          
            $values[(string)mfString::getInstance($row['value'])->noaccent()->lower()]=$row['energy_id'];
        }             
        return $values;
    }
   /* 
     static function getStatusI18nForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingStatusLeadI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id').
                           " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND lang='{lang}'".   
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingStatusLeadI18n::getTableField('status_id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $items=array();
         while ($item=$db->fetchObject('CustomerMeetingStatusLeadI18n'))
        {
           if ($item->get('id'))
               $item->loaded();
           $items[$item->get('status_id')]= $item;
        }           
        return $items;
    }  */  
    
     function toArrayForTransfer()
     {
         $values=parent::toArray(array('name'));
         $values['value']=(string)$this->getI18n();         
         return $values;
     }
     
      static function getEnergiesI18nForSelect($site=null)
    {
        $values=new mfArray();              
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>mfcontext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".DomoprimeEnergyI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeEnergyI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeEnergyI18n'))
        { 
            $values[$item->get('energy_id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
     
      function save()
     {
         parent::save();
         mfCacheFile::removeCache('domoprime_energy','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('domoprime_energy','admin',$this->getSite());         
         return $this;
     }
}
