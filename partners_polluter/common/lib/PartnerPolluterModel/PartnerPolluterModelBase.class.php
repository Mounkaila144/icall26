<?php

class PartnerPolluterModelBase extends mfObject2 {
     
    protected static $fields=array('polluter_id','name','extension','created_at','updated_at');
    
    const table="t_partner_polluter_model"; 
       protected static $foreignKeys=array('polluter_id'=>'PartnerPolluterCompany',
                                        ); // By default   
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
          return $this->loadByName((string)$parameters);
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
       $this->extension=isset($this->extension)?$this->extension:"pdf";
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
      $db->setParameters(array('name'=>$this->get('name'),'polluter_id'=>$this->get('polluter_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE polluter_id='{polluter_id}' AND name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function getExtension($prefix=".")
    {
       return $prefix.$this->get('extension');
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
                 $lang=mfContext::getInstance()->getUser()->getCountry();
             $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('model_id'=>$this->get('id'),'lang'=>$lang))
                     ->setQuery("SELECT * FROM ".PartnerPolluterModelI18n::getTable()." WHERE model_id='{model_id}' AND lang='{lang}';")
                     ->makeSiteSqlQuery($this->site);    
          //   echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->i18n; 
            $this->i18n=$db->fetchObject('PartnerPolluterModelI18n')->loaded()->setSite($this->getSite()); 
         }   
         return $this->i18n;
     } 
     
           
    function getPolluter()
    {
       if (!$this->_polluter_id)
       {
          $this->_polluter_id=new PartnerPolluterCompany($this->get('polluter_id'),$this->getSite());          
       }   
       return $this->_polluter_id;
    }   
    
    
    function toXML()
    {
        $values=$this->toArray();              
        $values['i18n']=$this->getI18n()->toXml();
        return $values;
    }
    
     
}
