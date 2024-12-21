<?php

class CustomerMeetingFormfieldBase extends OrderedObject {
     
    protected static $fields=array('name','form_id','is_visible','default','is_exportable','type','widget','position');
    protected static $foreignKeys=array('form_id'=>'CustomerMeetingForm'); // By default
 /*   static $databasetype=array('string'=>"VARCHAR(255) NOT NULL DEFAULT ''",
                     'integer'=>"INT(11) NULL DEFAULT NULL",
                     'text'=>"TEXT NOT NULL",
                     'boolean'=>"ENUM ('0','1') NOT NULL DEFAULT '0'",
                     'choice'=>"VARCHAR(255) NOT NULL DEFAULT ''",
                     'select'=>"VARCHAR(255) NOT NULL DEFAULT ''", //ENUM ({choices}) NOT NULL DEFAULT '{default}'",
                     'radio'=>"VARCHAR(255) NOT NULL DEFAULT ''", //ENUM ({choices}) NOT NULL DEFAULT '{default}'",
                     'checkbox'=>"VARCHAR(255) NOT NULL DEFAULT ''" //ENUM ({choices}) NOT NULL DEFAULT '{default}'",
                  );*/
    
    const table="t_customers_meeting_formfield"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['ns']) && isset($parameters['ns']))
             return $this->loadbyNamespaceAndName($parameters['ns'],$parameters['name']); 
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
    
    protected function loadbyNamespaceAndName($ns,$name) {                 
         $db=mfSiteDatabase::getInstance()->setParameters(array('name'=>$name,'ns'=>$ns));
         $db->setQuery("SELECT * FROM ".self::getTable().
                       " INNER JOIN ".self::getOuterForJoin('form_id').
                       " WHERE ".self::getTableField('name')."='{name}' AND ".CustomerMeetingForm::getTableField('name')."='{ns}'".                   
                       ";")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
         
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
    
     protected function executeLastPositionQuery($db)
    {
     $db->setParameter('form_id',$this->get('form_id'))
        ->setQuery("SELECT max(position) FROM ".static::getTable()." WHERE form_id={form_id};")
        ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeShiftUpQuery($db)
    {
       $db->setParameter('form_id',$this->get('form_id'))
          ->setQuery("UPDATE ".static::getTable()." SET position=position + 1 WHERE position < %d AND position >= %d AND form_id={form_id};")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftDownQuery($db)
    {
        $db->setParameter('form_id',$this->get('form_id'))
           ->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND position <= %d AND form_id={form_id};")
           ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeShiftQuery($db)
    {
        $db->setParameter('form_id',$this->get('form_id'))
           ->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND form_id={form_id};")
           ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeSiblingQuery($db)
    {
       $db->setParameter('form_id',$this->get('form_id'))
          ->setQuery("SELECT * FROM ".static::getTable()." WHERE position={position} AND form_id={form_id};")
          ->makeSiteSqlQuery($this->site);     
    }
    
    function getForm()
    {
       if (!$this->_form_id)
       {
           $this->_form_id=new CustomerMeetingForm($this->get('form_id'),$this->getSite());
       }   
       return $this->_form_id;
    }
    
    function getI18n()
    {
       if ($this->formfield_i18n===null)
       {
             $this->formfield_i18n= new CustomerMeetingFormFieldI18n(array('formfield'=>$this,'lang'=>mfContext::getInstance()->getUser()->getLanguage()));
       }   
       return $this->formfield_i18n;
    }   
    
    function setI18n($i18n)
    {
        $this->formfield_i18n=$i18n;
        return $this;
    }
    
     function updateWidget()
     {
        if ($this->get('type')=='string') 
           $this->set('widget','input'); 
        elseif ($this->get('type')=='integer') 
           $this->set('widget','input'); 
        elseif ($this->get('type')=='text') 
           $this->set('widget','text'); 
        elseif ($this->get('type')=='boolean') 
           $this->set('widget','boolean'); 
       //  elseif (in_array($this->get('type'),array('select','radio','checkbox'))) 
     //      $this->set('widget',$this->get('type')); 
        return $this;
     }
    
     function getTypeForDatabase()
     {             
        // echo "Type=".$this->get('type')." === ".self::$databasetype[$this->get('type')]."<br/>";
        // return self::$databasetype[$this->get('type')];
         return "VARCHAR(255) NOT NULL DEFAULT ''";
     }
 
     function getNameForDatabase()
     {
         return $this->getForm()->get('name')."_".$this->get('name');
     }
     
     function getPreviousNameForDatabase()
     {
         if ($this->hasPropertyChanged('name'))
            return $this->getForm()->get('name')."_".$this->getPropertyChanged('name');
         return $this->getNameForDatabase();
     }
     
     function isVisible()
     {
         return (boolean)($this->get('is_visible')=='YES');
     }
     
     
     function isExportable()
     {
         return (boolean)($this->get('is_exportable')=='YES');
     }
     
     
     function getCredential($suffix="")
     {
         return "customers_forms_".($suffix?$suffix."_":"").$this->getNameForDatabase();
     }
       
     
     function toArrayForXml()
     {
         $values=parent::toArray(array('name','is_visible','default','is_exportable','type','widget','position'));
      //   if ($this->getI18n())
      //   $values['i18n']=$this->getI18n()->toArrayForXml();
         return $values;
     }
}     
