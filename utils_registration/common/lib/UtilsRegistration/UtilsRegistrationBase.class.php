<?php


class  UtilsRegistrationBase extends mfObject2{
    
    
     protected static $fields=array('month','key','year','registration','created_at','updated_at');
    const table="t_utils_registration"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['year']) && isset($parameters['month']))
              return $this->loadByYearAndMonth((string)$parameters['year'],(string)$parameters['month']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['registration']))
              return $this->loadByRegistration((string)$parameters['registration']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
      }   
    }


    

     protected function loadByRegistration($name)
    {     
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('registration'=>$name))              
            ->setQuery("SELECT ".self::getFieldsAndKeyWithTable()." FROM ".self::getTable().                       
                       " WHERE registration='{registration}';")
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
        $db->setParameters(array('registration'=>$this->get('registration'),'year'=>$this->get('year'),'month'=>$this->get('month'),$this->getKey()))
            ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE registration='{registration}' AND year='{year}' AND month='{month}' ".$key_condition)
            ->makeSiteSqlQuery($this->site);   
    }
    
   /*  function generate()
    {
        $day=new Day();
        $db= mfSiteDatabase::getInstance() ;
        $db->setParameters(array("year"=>$day->getYear()))
            ->setQuery( "SELECT registration FROM ".self::getTable().
                        " WHERE year='{year}'". 
                        " ORDER BY id DESC LIMIT 1;")
            ->makeSiteSqlQuery($this->getSite()); 
        $row=$db->fetchRow();
        $max= $row[0];
        if($max===null)
            $max=01 .$day->getMonth().$day->getYear();
        else
           $max++;
        
        $item=new UtilsRegistration();
        $item->set('year',$day->getYear());
        $item->set('month',$day->getMonth());
        $item->set('registration',$max);
        return $item;
      
    }*/
     
    function getFormatter()
    {
        if ($this->formatter===null)
           $this->formatter=new UtilsRegistrationFormatter($this);
        return $this->formatter;
    }
    
    static function generateKeyForYear($key='',$start=null,$site=null)
    {
        $day=new Day();
        $db= mfSiteDatabase::getInstance() 
            ->setParameters(array("year"=>$day->getYear(),'key'=>$key))
            ->setQuery( "SELECT max(registration) FROM ".self::getTable().
                        " WHERE year='{year}' AND `key`='{key}'". 
                        ";")
            ->makeSiteSqlQuery($site); 
        $row=$db->fetchRow();         
        $max=intval($row[0])+1;               
        $item = new UtilsRegistration(null,$site);
        $item->set('year',$day->getYear());    
        $item->set('key',$key);    
        $item->set('registration',($start !== null && $max < $start)?$start:$max);
        return $item->save();
    }        
}
