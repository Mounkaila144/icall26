<?php

class CustomerMeetingStatusLeadBase extends mfObject2 {
     
    protected static $fields=array('name','icon','color');
    const table="t_customers_meeting_status_lead"; 
    
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
    
   
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/view/data/customers/meetings/status/call/".$this->get('id');
    }  
    /* =================================== P I C T U R E =========================================== */
    
    public function getIcon()
    {
      if (!$this->get('_icon'))      
      {    
         $this->_icon=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('icon'),
                 "urlPath"=>url("/nocache/data/customers/meetings/status/lead/".$this->get('id')."/","web","frontend"),
                 "url"=>url("/nocache/data/customers/meetings/status/lead/".$this->get('id')."/".$this->get('icon'),"web","frontend")
              ));
      }
      return $this->_icon;     
    }
    
    public function deleteIcon()
    {
        $this->getIcon()->remove(); 
        $this->set('icon','');
        $this->save();
    }       
 
     public function setI18n($status_i18n)
     {
         $this->_status_i18n=$status_i18n;
         return $this;
     } 
     
     public function getI18n($lang=null)
     {      
         if (!$this->_status_i18n)
         {
              if ($lang==null)
                  $lang=  mfcontext::getInstance()->getUser()->getCountry();
             $this->_status_i18n=new CustomerMeetingStatusLeadI18n(array('lang'=>$lang,"status_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->_status_i18n;
     } 
       
     
     static function getStatusForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerMeetingStatusLeadI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingStatusLeadI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerMeetingStatusLeadI18n'))
        { 
            $values[$item->get('status_id')]=$item->get('value');
        }      
        return $values;
    }
    
    static function getStatusI18nForSelect($lang,ConditionsQuery $where,$site=null)
    {
        $cache= new mfCacheFile('meeting_status_lead.conditions.'.md5($where->getWhere().$lang),'admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
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
        {
            $cache->register(serialize(array()));
            return array();
        } 
        $items=array();
         while ($item=$db->fetchObject('CustomerMeetingStatusLeadI18n'))
        {
           if ($item->get('id'))
               $item->loaded();
           $items[$item->get('status_id')]= $item;
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
         mfCacheFile::removeCache('meeting_status_lead','admin',$this->getSite());         
         return $this;
     }
     
    function delete()
    {
        parent::delete(); 
        mfCacheFile::removeCache('meeting_status_lead','admin',$this->getSite());
        return $this;
    }  
}
