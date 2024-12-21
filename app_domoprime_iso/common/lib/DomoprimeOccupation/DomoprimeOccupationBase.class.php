<?php

class DomoprimeOccupationBase extends mfObject2 {
     
    protected static $fields=array('name');
    const table="t_domoprime_iso_occupation"; 
    
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
             $this->i18n=new DomoprimeOccupationI18n(array('lang'=>$lang,"occupation_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
       
     
    static function getOccupationForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeOccupationI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeOccupationI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeOccupationI18n'))
        { 
            $values[$item->get('occupation_id')]=$item->get('value');
        }      
        return $values;
    }
            
    
     static function getOccupationI18nForSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeOccupationI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeOccupationI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeOccupationI18n'))
        { 
            $values[$item->get('occupation_id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
    
    static function getOccupationsByNames($site=null)
    {
        $values=array();             
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".DomoprimeOccupation::getTableFields(array('name','id'))." FROM ".DomoprimeOccupation::getTable().
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($row=$db->fetchArray())
        { 
            $values[$row['name']]=$row['id'];
        }      
        return $values;
    }
   
    
    function toArrayForTransfer()
     {
         $values=parent::toArray(array('name'));    
         $values['value']=(string)$this->getI18n();         
         return $values;
     }
    
}
