<?php

class UserFunctionI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','function_id','lang','created_at','updated_at');
    const table="t_users_function_i18n"; 
    protected static $foreignKeys=array('function_id'=>'UserFunction'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['function_id']))
              return $this->loadByLangAndFunctionId((string)$parameters['lang'],(string)$parameters['function_id']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          // For Import
          if (isset($parameters['lang']) && isset($parameters['value']))
              return $this->loadByLangAndValue((string)$parameters['lang'],(string)$parameters['value']); 
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
    
     protected function loadByLangAndFunctionId($lang,$function_id)
    {
       $this->set('function_id',$function_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('function_id'=>$function_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND function_id={function_id};")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
      protected function loadByLangAndValue($lang,$value)
    {
       $this->set('value',$value);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('value'=>$value,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND value='{value}';")
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
            ->setParameters(array("function_id"=>$this->get('function_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE function_id={function_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        parent::delete();              
        if (!$this->hasSibbling())
            $this->getUserFunction()->delete();
        return $this;
    }  
   
     function getUserFunction()
    {
       if (!$this->_function_id)
       {
          $this->_function_id=new UserFunction($this->get('function_id'),$this->getSite());          
       }   
       return $this->_function_id;
    }    
    
    
     public function getNameForIcon($default="")
    {
       return preg_replace('/[^a-z0-9]/iu','', $this->get('value')).$default; 
    }  

    function __toString() {
        return (string)$this->get('value');
    }
}
