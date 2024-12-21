<?php

class CustomerMeetingFormBase extends OrderedObject {
     
    
    protected static $fields=array('name','position','is_active','is_admin');
    const table="t_customers_meeting_form"; 
    
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
         $this->is_active=isset($this->is_active)?$this->is_active:'Y';
         $this->is_admin=isset($this->is_admin)?$this->is_admin:'N';
         parent::getDefaults();
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
     $db->setQuery("SELECT max(position) FROM ".static::getTable().";")
        ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeShiftUpQuery($db)
    {
       $db->setQuery("UPDATE ".static::getTable()." SET position=position + 1 WHERE position < %d AND position >= %d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeShiftDownQuery($db)
    {
        $db->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d AND position <= %d;")
            ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeShiftQuery($db)
    {
        $db->setQuery("UPDATE ".static::getTable()." SET position=position - 1 WHERE position > %d;")
           ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeSiblingQuery($db)
    {
       $db->setQuery("SELECT * FROM ".static::getTable()." WHERE position={position};")
          ->makeSiteSqlQuery($this->site);     
    }
    
    
    function getI18n()
    {
       if ($this->i18n===null)
       {
           $this->i18n= new CustomerMeetingFormI18n(array('form'=>$this,'lang'=>mfContext::getInstance()->getUser()->getLanguage()));
       }   
       return $this->i18n;
    }
    
    function getFormfields()
    {
        return $this->formfields;
    }
    
    function hasFormfields()
    {
        return !empty($this->formfields);
    }
    
    function setUser($user)
    {
        $this->user=$user;
        return $this;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function hasUser()
    {
        return (boolean)$this->user;
    }
  
    function getValidators()
    {        
        $schema=new CustomerMeetingFormValidatorSchema();        
        foreach ($this->formfields as $formfield) 
        {                          
            if ($this->hasUser() && $this->getUser()->hasCredential(array(array('meetings_forms_extra_'.$this->get('name').'_'.$formfield->get('name').'_field_hidden'))))
                continue;
            $schema->addValidator($formfield->get('name'),$formfield->getI18n()->getValidator());
        }      
        $schema->request=$this->getI18n()->get('value');
        return $schema;
    }
    
    function getValidatorsForHold()
    {  // meetings_forms_extra_contract_hold_STEPHANEPOSE_commentairepose_field_active     
        $schema=new CustomerMeetingFormValidatorSchema();           
        foreach ($this->formfields as $formfield) 
        {                
            if ($this->hasUser() && !$this->getUser()->hasCredential(array(array('meetings_forms_extra_contract_hold_'.$this->get('name').'_'.$formfield->get('name').'_field_active'))))
                continue;
            $schema->addValidator($formfield->get('name'),$formfield->getI18n()->getValidator());
        }      
        $schema->request=$this->getI18n()->get('value');
        return $schema;
    }
        
    function getOptions()
    {
       $options=array();
       foreach ($this->formfields as $formfield) 
        {           
            $options[$formfield->get('name')]=$formfield->getI18n()->getOptions();
        }  
        return $options;
    }
        
    function save()
    {
        if ($this->hasPropertyChanged('name') && $this->isLoaded())
        {            
            CustomerMeetingForms::updateSchemaFromForm($this);
        }   
        return parent::save();
    }
    
    
    function isAdmin($true=true,$false=false)
    {
        return $this->get('is_admin')=='Y'?$true:$false;
    }    


    
}
