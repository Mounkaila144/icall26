<?php

class UserProfileI18nBase extends mfObjectI18n {
     
    const table="t_users_profile_i18n"; 
    protected static $fields=array('profile_id','lang','value','created_at','updated_at');   
    protected static $foreignKeys=array('profile_id'=>'UserProfile'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
            if (isset($parameters['lang']) && isset($parameters['profile_id']))
              return $this->loadByLangAndProfileId((string)$parameters['lang'],(string)$parameters['profile_id']); 
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

    protected function loadByLangAndProfileId($lang,$profile_id)
    {
       $this->set('profile_id',$profile_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('profile_id'=>$profile_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND profile_id='{profile_id}';")
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
      $db->setParameters(array('value'=>$this->get('value'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE value='{value}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);       
    }
    
     protected function hasSibbling()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("profile_id"=>$this->get('profile_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE profile_id={profile_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        parent::delete();              
        if (!$this->hasSibbling())
            $this->getProfile()->delete();
        return $this;
    }  
    
    
    function getProfile()
    {
        return $this->_profile_id=$this->_profile_id===null?new UserProfile($this->get('profile_id'),$this->getSite()):$this->_profile_id;
    }
    
    function __toString() {
        return (string)$this->get('value');
    }
    
      function getEscapedValue()
    {             
        return preg_replace('/[^abcdefghijklmnopqrstuvwxyz0123456789\.\-]/i', "_", str_replace(" ","_",mfTools::I18N_noaccent(strtolower($this->get('value')))));
    }
}
