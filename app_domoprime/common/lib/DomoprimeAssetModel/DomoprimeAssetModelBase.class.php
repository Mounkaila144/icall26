<?php

class DomoprimeAssetModelBase extends mfObject2 {
     
    protected static $fields=array('name');
    const table="t_domoprime_asset_model"; 
         
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
         return $this->loadByEmail((string)$parameters);
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
    
    function setI18n($i18n)
    {
        $this->i18n=$i18n;
        return $this;
    }
    
    function hasI18n()
    {
        return (boolean) $this->getI18n();
    }
    
     public function getI18n($lang=null)
     {       
         if ($this->i18n===null)
         {
             if ($lang==null)
                 $lang=mfContext::getInstance()->getUser()->getCountry();
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('model_id'=>$this->get('id'),'lang'=>$lang))
                     ->setQuery("SELECT * FROM ".DomoprimeAssetModelI18n::getTable()." WHERE model_id='{model_id}' AND lang='{lang}';")
                     ->makeSiteSqlQuery($this->site);    
            if (!$db->getNumRows())
                return null; 
            $this->i18n=$db->fetchObject('DomoprimeAssetModel')->loaded()->setSite($this->getSite()); 
         }   
         return $this->i18n;
     } 
       
    static function getModelsI18nForSelect($site=null)
    {                  
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$lang))
                ->setQuery("SELECT ".DomoprimeAssetModelI18n::getFieldsAndKeyWithTable()." FROM ".  DomoprimeAssetModelI18n::getTable().                                                 
                           " WHERE lang='{lang}';")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $items=array();
        while ($item=$db->fetchObject('DomoprimeAssetModelI18n'))
        {
           $items[$item->get('model_id')]=$item->get('value')." (".$item->get('model_id').")" ;;
        }     
        return $items;
    }
    
}