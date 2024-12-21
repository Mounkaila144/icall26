<?php

class CustomerMeetingFormfieldI18nBase extends mfObjectI18n {
     
    protected static $fields=array('formfield_id','request','parameters','lang','created_at','updated_at');
    protected static $foreignKeys=array('formfield_id'=>'CustomerMeetingFormfield'); // By default
    const table="t_customers_meeting_formfield_i18n"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['lang']) && isset($parameters['formfield_id']))
             return $this->loadbyLangAndFormFieldId((string)$parameters['lang'],(string)$parameters['formfield_id']); 
            if (isset($parameters['lang']) && isset($parameters['formfield']))
             return $this->loadbyLangAndFormField((string)$parameters['lang'],$parameters['formfield']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters); 
         return $this->loadbyName((string)$parameters);  
      }   
    }
    
    protected function loadByLangAndFormFieldId($lang,$formfield_id)
    {
         $this->set('lang',$lang);
         $this->set('formfield_id',$formfield_id);
         $db=mfSiteDatabase::getInstance()->setParameters(array('lang'=>$lang,'formfield_id'=>$formfield_id));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE lang='{lang}' AND formfield_id='{formfield_id}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByLangAndFormField($lang,$formfield)
    {
         $this->set('lang',$lang);
         $this->set('formfield_id',$formfield);
         $db=mfSiteDatabase::getInstance()->setParameters(array('lang'=>$lang,'formfield_id'=>$formfield->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE lang='{lang}' AND formfield_id='{formfield_id}';")
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
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");     
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
    /*  $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   */   
    }
    
    protected function hasSibbling()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("formfield_id"=>$this->get('formfield_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE formfield_id={formfield_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        if (parent::delete()===false)       
            return $this;
        if (!$this->hasSibbling())
            $this->getFormField()->delete();
        return $this;
    } 
  
     public function getFormField()
     {        
         if (!$this->_formfield_id)
         {    
             $this->_formfield_id=new CustomerMeetingFormfield($this->get('formfield_id'),$this->getSite());
         }   
         return $this->_formfield_id;
     } 
     
     function setParameters($parameters)
     {                 
         $fields=array();
         if ($this->getFormField()->get('type')=='string')
             $fields=array('min_length','max_length','required','size','default','is_visible','is_exportable');
         elseif ($this->getFormField()->get('type')=='text')
             $fields=array('min_length','max_length','required','cols','default','rows','is_visible','is_exportable');
         elseif ($this->getFormField()->get('type')=='integer')
             $fields=array('min','max','required','size','default','is_visible','is_exportable');
         elseif ($this->getFormField()->get('type')=='choice')
             $fields=array('multiple','required','choices','widget','default','is_visible','is_exportable');
         // Sorted in function of type
         foreach ($parameters as $name=>$value)
         {        
            if (!in_array($name,$fields))
               unset($parameters[$name]);
         }
         $this->set('parameters',serialize($parameters));
         return $this;
     }
     
     function _getParameters()
     {
         return $this->_parameters=$this->_parameters===null?(array)unserialize($this->get('parameters')):$this->_parameters;
     }   
     
     function getParameters($values=array()) {
        return array_merge($this->_getParameters(),$values);       
     }
      
     function getOptions()
     {
        if ($this->_options ===null)
        {    
       // $parameters=(array)unserialize($this->get('parameters'));
             $this->_options=$this->_getParameters();
             $fields=array();
             if ($this->getFormField()->get('type')=='string')
                 $fields=array('min_length','max_length','required');      
             elseif ($this->getFormField()->get('type')=='integer')
                 $fields=array('min','max','required');
             elseif ($this->getFormField()->get('type')=='text')
                  $fields=array('min_length','max_length','required');
             elseif ($this->getFormField()->get('type')=='choice')
                 $fields=array('multiple','required','choices');         
            foreach ($this->_options as $name=>$value)
            {
                if (!in_array($name,$fields))
                   unset($this->_options[$name]);            
            }             
        }
        return $this->_options;
     }
     
     function getValidator()
     {                
         $options=$this->getOptions();
         $parameters=$this->_getParameters();
        // var_dump($this->getFormField()->get('type'));
         if ($this->getFormField()->get('type')=='string')
             $validator=new CustomerMeetingFormValidatorString($options);
         elseif ($this->getFormField()->get('type')=='text')
             $validator=new CustomerMeetingFormValidatorString($options);
         elseif ($this->getFormField()->get('type')=='integer')
             $validator=new CustomerMeetingFormValidatorInteger($options);
         elseif ($this->getFormField()->get('type')=='choice')
             $validator=new CustomerMeetingFormValidatorChoice(array_merge($options,array('key'=>true)));
         elseif ($this->getFormField()->get('type')=='boolean')
             $validator=new CustomerMeetingFormValidatorBoolean($options);            
         $validator->widget=$this->getFormField()->get('widget');
         $validator->setRequest($this->get('request'));  
         // Parameters for field
         if ($this->getFormField()->get('type')=='string')
              $validator->setSize($parameters['size']);
         elseif ($this->getFormField()->get('type')=='integer')
              $validator->setSize($parameters['size']);
         elseif ($this->getFormField()->get('type')=='text')
         {    
              $validator->cols=$parameters['cols'];
              $validator->rows=$parameters['rows'];
         }     
         return $validator;      
     }
     
     function getParameter($name,$default=null)
     {
          // $parameters=(array)unserialize($this->get('parameters'));
        // return isset($parameters[$name])?$parameters[$name]:$default;
         $this->_getParameters();       
         return isset($this->_parameters[$name])?$this->_parameters[$name]:$default;
     }   
     
     
      function getOptionsForImport()
     {
        $parameters=$this->getOptions();
        if ($this->getFormField()->get('type')=='choice')
        {
            foreach ($parameters['choices'] as $index=>$parameter)
            {
                $parameters['choices'][$index]= mb_strtoupper(mfTools::I18N_noaccent($parameter));
            }    
        }
        return $parameters;
     }
     
     function getValidatorForImport()
     {
         $options=$this->getOptionsForImport();                    
         if ($this->getFormField()->get('type')=='string')
             $validator=new mfValidatorString($options);
         elseif ($this->getFormField()->get('type')=='text')
             $validator=new mfValidatorString($options);
         elseif ($this->getFormField()->get('type')=='integer')
             $validator=new mfValidatorInteger($options);
         elseif ($this->getFormField()->get('type')=='choice')                     
             $validator=new mfValidatorChoiceImport(array_merge($options,array('key'=>false,'noaccent'=>true,'upper'=>true)));         
         elseif ($this->getFormField()->get('type')=='boolean')
             $validator=new mfValidatorBoolean($options);  
         if ($validator)
           $validator->setOption('required',false);
         return $validator;
     }
     
     function getChoices()
     {
         return (array)$this->getParameter('choices');
     }
     
     function getChoicesForImport()
     {
          $values=array();
          foreach ($this->getChoices() as $value)
            {
                $values[]= mb_strtoupper(mfTools::I18N_noaccent($value));
            } 
            return $values;
     }
     
     function toArrayForXml()
     {
         $values=parent::toArray(array('request','lang'));
         $values['parameters']=json_encode($this->getParameters());
         return $values;
     }
}
