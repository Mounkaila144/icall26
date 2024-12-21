<?php

class CustomerMeetingTypeBase extends mfObject2 {
     
    protected static $fields=array('name');
    const table="t_customers_meeting_type"; 
    
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
    
   
    
 
     public function setI18n($type_i18n)
     {
         $this->_type_i18n=$type_i18n;
         return $this;
     } 
     
     public function getI18n($lang=null)
     {    
         if (!$this->_type_i18n)
         {
              if ($lang==null)
                $lang=  mfcontext::getInstance()->getUser()->getCountry();
             $this->_type_i18n=new CustomerMeetingTypeI18n(array('lang'=>$lang,"type_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->_type_i18n;
     } 
       
     
     static function getTypeI18nForSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerMeetingTypeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingTypeI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerMeetingTypeI18n'))
        { 
            $values[$item->get('type_id')]=strtoupper($item->get('value'));
        }      
        return $values;
    }
    
     static function getTypesI18nForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_type.conditions.'.md5($where->getWhere()),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters(array('lang'=>$lang)))
                ->setQuery("SELECT ".CustomerMeetingTypeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('type_id').
                           " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND lang='{lang}'".   
                           $where->getWhere().
                           " GROUP BY ".CustomerMeetingTypeI18n::getTableField('type_id').
                           " ORDER BY value ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
        {
            $cache->register(serialize(array()));
            return array();
        } 
        $items=array();
         while ($item=$db->fetchObject('CustomerMeetingTypeI18n'))
        {
           if ($item->get('id'))
               $item->loaded();
           $items[$item->get('type_id')]= $item;
        } 
        $cache->register(serialize($items));
        return $items;
    }      
    
     function toArrayForTransfer()
     {
         $values=parent::toArray(array('name','color'));
         $values['value']=(string)$this->getI18n();         
         return $values;
     }
     
     function save()
    {
        parent::save();
        mfCacheFile::removeCache('meeting_type','admin',$this->getSite());         
        return $this;
    }
     
    function delete()
    {
        parent::delete();
        mfCacheFile::removeCache('meeting_type','admin',$this->getSite());         
        return $this;
    }
}
