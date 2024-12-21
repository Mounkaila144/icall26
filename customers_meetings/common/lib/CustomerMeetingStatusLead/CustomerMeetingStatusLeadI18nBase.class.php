<?php

class CustomerMeetingStatusLeadI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','status_id','lang','created_at','updated_at');
    const table="t_customers_meeting_status_lead_i18n"; 
    protected static $foreignKeys=array('status_id'=>'CustomerMeetingStatusLead'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['status_id']))
              return $this->loadByLangAndStatusId((string)$parameters['lang'],(string)$parameters['status_id']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           // Import
          if (isset($parameters['lang']) && isset($parameters['value']))          
              return $this->loadByLangAndValue($parameters['lang'],$parameters['value']);   
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }
    
  /*  protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
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
    
     protected function loadByLangAndStatusId($lang,$status_id)
    {
       $this->set('status_id',$status_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('status_id'=>$status_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND status_id={status_id};")
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
            ->setParameters(array("status_id"=>$this->get('status_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE status_id={status_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        if (parent::delete()===false)       
            return $this;
        if (!$this->hasSibbling())
            $this->getStatus()->delete();
        return $this;
    }  
   
     function getStatus()
    {
       if (!$this->_status_id)
       {
          $this->_status_id=new CustomerMeetingStatusLead($this->get('status_id'),$this->getSite());          
       }   
       return $this->_status_id;
    }    
    
    
     public function getNameForIcon($default="")
    {
       return preg_replace('/[^a-z0-9]/iu','', $this->get('value')).$default; 
    }  
   
}
