<?php


class DomoprimeClassBase extends mfObject2 {
     
    protected static $fields=array('name','color','coef','prime','pack_prime','multiple','multiple_floor','multiple_top','multiple_wall','coef_prime','subvention','bbc_subvention');
    protected static $fieldsNull=array('multiple_floor','multiple_top','multiple_wall','prime','pack_prime','subvention','bbc_subvention');
    const table="t_domoprime_class"; 
    
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
             $this->i18n=new DomoprimeClassI18n(array('lang'=>$lang,"class_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
       
     function getCoefficient()
     {
         return (float)$this->get('coef');
     }
     
       function getMultiple()
     {
         return (float)$this->get('multiple');
     }
     
    static function getClassForI18nSelect($site=null)
    {           
        $values=array();                 
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $cache= new mfCacheFile('domoprime_class.select.'.md5($lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read()); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeClassI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeClassI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return $values;
        }
        while ($item=$db->fetchObject('DomoprimeClassI18n'))
        { 
            $values[$item->get('class_id')]=$item->get('value');
        }  
        $cache->register(serialize($values));
        return $values;
    }
    
   static function getClassI18nForSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $cache= new mfCacheFile('domoprime_class.list.select.'.md5($lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeClassI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeClassI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
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
    
     
    function toArrayForDocument()
    {
        $values=array();
        $values['modest_and_very_modest']=in_array($this->get('name'),array(0,1))?"1":"0";            
        $values['modest']=$this->get('name')==0?"1":"0"; 
        $values['very_modest']=$this->get('name')==1?"1":"0"; 
        $values['value']=$this->get('name');
        $values['text']=(string)$this->getI18n();
        return $values;
    }
    
     function toArrayForDocumentPdf()
    {
        return $this->toArrayForDocument();
    }
    
    function toArrayForQuotation()
    {
        $values=array();    
        $values['value']=$this->get('name');
        $values['text']=(string)$this->getI18n();
        return $values;
    }
    
    function toXML()
    {
        return $this->toArray();
    }
    
    
    static function getClassesByNames(mfArray $names,$site=null)
    {
        $values=new mfArray();             
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".DomoprimeClass::getTable().
                           " WHERE name IN ('".$names->implode("','")."');")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeClass'))
        { 
            $values[$item->get('name')!==''?$item->get('name'):"NULL"]=$item->get('id');
        }      
        return $values;
    }
    
      static function getClassByNameForSelect($site=null)
    {       
        $values=new mfArray();          
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".DomoprimeClass::getTable().
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeClass'))
        { 
            $values[$item->get('id')]=$item->get('name');
        }      
        return $values;
    } 
    
    function hasMultipleFloor()
    {
        return (boolean)$this->get('multiple_floor');
    }
    
     function hasMultipleTop()
    {
        return (boolean)$this->get('multiple_top');
    }
    
     function hasMultipleWall()
    {
        return (boolean)$this->get('multiple_wall');
    }
    
    function getMultipleByType($type)
    {
        return $this->get('multiple_'.$type);
    }
    
    function getSubvention()
    {
        return new FloatFormatter($this->get('subvention'));
    }
    
    function getBBCSubvention()
    {
        return new FloatFormatter($this->get('bbc_subvention'));
    }
    
    function hasSubvention()
    {
        return (boolean)$this->get('subvention');
    }
    
    function hasBBCSubvention()
    {
        return (boolean)$this->get('bbc_subvention');
    }
    
    function hasCoefPrime()
    {
        return (boolean)$this->get('coef_prime');
    }
    
    function getCoefPrime()
    {
       return new FloatFormatter($this->get('coef_prime'));
    }
    
    function save()
    {
        parent::save();
        mfCacheFile::removeCache('domoprime_class','admin',$this->getSite());         
        return $this;
    }

     function delete()
    {
        parent::delete();
        mfCacheFile::removeCache('domoprime_class','admin',$this->getSite());         
        return $this;
    }
}
