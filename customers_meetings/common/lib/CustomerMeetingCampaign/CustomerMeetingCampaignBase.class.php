<?php

class CustomerMeetingCampaignBase extends mfObject2 {
     
    protected static $fields=array('name');
    const table="t_customers_meeting_campaign"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['name']))
             return $this->loadbyname((string)$parameters['name']); 
          return $this->add($parameters); 
      }   
      else
      {         
         if (is_numeric($parameters)) 
            return $this->loadbyId((string)$parameters);          
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
    
   
   
     static function getCampaignSelect($site=null)
    {
        $values=array();            
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CustomerMeetingCampaign::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerMeetingCampaign'))
        { 
            $values[$item->get('id')]=$item->get('name');
        }      
        return $values;
    }
    
    
     function toArrayForTransfer()
     {
         $values=parent::toArray(array('name'));        
         return $values;
     }
     
     
     static function createAndLoad(mfArray $utm_campaigns,$site=null)
     {        
         $collection=new CustomerMeetingCampaignCollection(null,$site);
         if ($utm_campaigns->isEmpty())
             return $collection;
         // load
         $values=new mfArray();
        foreach ($utm_campaigns as $utm_campaign)
           $values[]=  mfSiteDatabase::getInstance()->escape($utm_campaign); 
         $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".CustomerMeetingCampaign::getTable().
                           " WHERE name IN('".$values->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if ($db->getNumRows())
        {
            while ($item=$db->fetchObject('CustomerMeetingCampaign'))
            { 
                $collection[$item->get('name')]=$item->loaded();
                $utm_campaigns->findAndRemove($item->get('name'));
            }      
            $collection->loaded();
        }
        // Create
        foreach ($utm_campaigns as $campaign)
        {
            $item=new CustomerMeetingCampaign(null,$site);
            $item->set('name',$campaign);
            $collection[$campaign]=$item;
        }
        $collection->save();
        return $collection;         
     } 
     
     function save()
    {
        parent::save();
        mfCacheFile::removeCache('meeting_companies','admin',$this->getSite());         
        return $this;
    }

    function delete()
    {
        parent::delete();
        mfCacheFile::removeCache('meeting_companies','admin',$this->getSite());         
        return $this;
    }
    
     static function getCampaignsForSelect($site=null){
        static $values=null;      
        if ($values)
            return $values;   
        $values=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT name,id FROM ".self::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['id']]=$row['name'];
        }              
        return $values;
    }
    
}
