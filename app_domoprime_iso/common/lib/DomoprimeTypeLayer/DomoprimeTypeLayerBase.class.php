<?php

class DomoprimeTypeLayerBase extends mfObject2 {
     
    protected static $fields=array('name');
    const table="t_domoprime_iso_type_layer"; 
    
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
             $this->i18n=new DomoprimeTypeLayerI18n(array('lang'=>$lang,"type_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
       
     
    static function getTypeLayerForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeTypeLayerI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeTypeLayerI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeTypeLayerI18n'))
        { 
            $values[$item->get('type_id')]=$item->get('value');
        }      
        return $values;
    }
            
    
     static function getTypeLayerI18nForSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".DomoprimeTypeLayerI18n::getFieldsAndKeyWithTable()." FROM ".DomoprimeTypeLayerI18n::getTable().
                           " WHERE lang='{lang}' ORDER BY value ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('DomoprimeTypeLayerI18n'))
        { 
            $values[$item->get('type_id')]=$item->loaded()->setSite($site);
        }      
        return $values;
    }
   
    
    
     static function getLayersByNames($site=null)
    {
        $values=array();             
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".DomoprimeTypeLayer::getTableFields(array('name','id'))." FROM ".DomoprimeTypeLayer::getTable().
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
