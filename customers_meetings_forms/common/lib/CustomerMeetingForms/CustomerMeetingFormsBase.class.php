<?php

class CustomerMeetingFormsBase extends mfObject2 {
     
    
    protected static $fields=array('meeting_id','contract_id','data','is_hold','is_processed','updated_at','created_at');
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting','contract_id'=>'CustomerContract'); // By default
    protected static $fieldsNull=array('meeting_id','contract_id');
    const table="t_customers_meeting_forms"; 
    protected static $default_values=null,$forms_schema=null;
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['meeting_id']))
             return $this->loadbyMeetingId((string)$parameters['meeting_id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if ($parameters instanceof CustomerMeeting)
            return $this->loadByMeeting($parameters);
         if ($parameters instanceof CustomerContract)
            return $this->loadByContract($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);       
      }   
    }
    
    protected function loadByContract($contract)
    {
         $this->set('contract_id',$contract);
         $db=mfSiteDatabase::getInstance()->setParameters(array('contract_id'=>$contract->get('id'),'meeting_id'=>$contract->get('meeting_id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id='{contract_id}' OR meeting_id='{meeting_id}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByMeeting($meeting)
    {
         $this->set('meeting_id',$meeting);
         $db=mfSiteDatabase::getInstance()->setParameters(array('meeting_id'=>$meeting->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    static function getSchemaCache($site=null)
    {             
       $site=($site==null)?mfContext::getInstance()->getSite()->getSite():$site;             
      //  echo mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/data/meetings/forms/schema.dat";
        return new File(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/data/meetings/forms/schema.dat"); 
    }    
    
     static function getParametersCache($site=null)
    {
        $site=($site==null)?mfContext::getInstance()->getSite()->getSite():$site;         
        return new File(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/admin/data/meetings/forms/parameters.dat"); 
    }    
    
    static function getDynamicFields()
    {        
        $cache=self::getSchemaCache();    
        if ($cache->isExist())
            return unserialize($cache->getContent());
        return array();
    }
    
    static function getFields() { // Not so clean but no other solution               
        return array_unique(array_merge(parent::getFields(),(array)static::getDynamicFields()));
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");    
        $this->is_processed=isset($this->is_processed)?$this->is_processed:"NO";    
        $this->is_hold=isset($this->is_hold)?$this->is_hold:"NO";           
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
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    
      
     
      function getCustomerMeeting()
    {
        if (!$this->_meeting_id)
        {
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());
        }    
        return $this->_meeting_id;
    }
    
    protected function setDataInFields($data,$parameters)
    {             
       foreach ($data as $form=>$formfields)
       {
           foreach ($formfields as $formfield=>$value)
           {
               $options=$parameters[$form][$formfield];
               if (isset($options['choices']))
               {                   
                  if (is_array($value))
                  {                        
                      $values=array();
                      foreach ($value as $val)                      
                         $values[]=$options['choices'][$val];                      
                      $value=implode("|",$values);   // Separator for data
                  }    
                  else
                      $value=$options['choices'][$value];
               }                             
                $this->set($form."_".$formfield,$value); // Separator for foeld name
           }     
       }      
    }        
    
    function setDefaultValues($data)
    {       
       if (self::$default_values===null)
           self::$default_values=CustomerMeetingFormUtils::getDefaultValues($this->getSite());    
       foreach (self::$default_values as $form_name=>$form)  
       {
           foreach ($form as $field_name=>$field)
           {
              if (!isset($data[$form_name][$field_name])) 
              {
                  $data[$form_name][$field_name]=$field;
              }    
           }    
       }  
       return $data;
    } 
    
    static function getDefaultsData($site=null)
    {
        if (self::$default_values===null)
           self::$default_values=CustomerMeetingFormUtils::getDefaultValues($site); 
        return self::$default_values;
    }
    
   /* function setData($data,$parameters=array())
    {               
       if (self::$default_values===null)
           self::$default_values=CustomerMeetingFormUtils::getDefaultValues($this->getSite()); 
    //   $save_data=$this->getData();
       foreach (self::$default_values as $form_name=>$form)  
       {
           foreach ($form as $field_name=>$field)
           {
              if (!isset($data[$form_name][$field_name])) 
              {
                  $data[$form_name][$field_name]=$field;
              }    
           }    
       }        
      // echo "<pre>"; var_dump($data); echo "</pre>"; 
       $this->set('data',serialize(array_merge($this->getData(),$data)));   
       $this->setDataInFields($data,$parameters);          
       return $this;
    }*/
    
     function setData($data,$parameters=array())
    {               
       if (self::$default_values===null)
           self::$default_values=CustomerMeetingFormUtils::getDefaultValues($this->getSite()); 
       $saved_data=$this->getData();
       // Get defaults values
       foreach (self::$default_values as $form_name=>$form)  
       {
           foreach ($form as $field_name=>$field)
           {
              if (!isset($saved_data[$form_name][$field_name])) 
              {
                  $saved_data[$form_name][$field_name]=$field;
              }    
           }    
       }        
       // deep merge 
       foreach ($data as $form_name=>$values)
       {
           foreach ($values as $formfield_name=>$value)
           {
               $saved_data[$form_name][$formfield_name]=$value;
           }    
       }    
      // echo "<pre>"; var_dump($data); echo "</pre>"; 
       $this->set('data',serialize($saved_data));   
       $this->setDataInFields($data,$parameters);          
       return $this;
    }
    
    function setDataFromImport($data)
    {        
       if (self::$default_values===null)
           self::$default_values=CustomerMeetingFormUtils::getDefaultValues($this->getSite());    
        foreach (self::$default_values as $form_name=>$form)  
        {
            foreach ($form as $field_name=>$field)
            {
               if (!isset($data[$form_name][$field_name])) 
               {
                   $data[$form_name][$field_name]=$field;
               }    
            }    
        }       
         $this->set('data',serialize($data));            
         return $this;
    }
    
    function getData()
    {       
       return (array)unserialize($this->get('data'));
    }
    
    function getData1()
    {
        return $this->_data1=$this->_data1===null?new mfArray((array)unserialize($this->get('data'))):$this->_data1;
    }
    
    function getDataFromFormFields($formfields,$default=null)
    {
      $data=$this->getData();
      $values=new mfArray();
      foreach ($formfields as $name=>$formfield)
      {
          $values[$name]=isset($data[$formfield->getForm()->get('name')][$formfield->get('name')])?$data[$formfield->getForm()->get('name')][$formfield->get('name')]:$default;
      }
      return $values;
    }        
    
    function getDataFromFormField(CustomerMeetingFormField $formfield,$default=null)
    {       
        if ($this->_data===null)
        {           
            $this->_data=$this->getData();                        
        }    
        return isset($this->_data[$formfield->getForm()->get('name')][$formfield->get('name')])?$this->_data[$formfield->getForm()->get('name')][$formfield->get('name')]:$default;
    }
    
    function getDataFromFieldname($ns,$name,$default=null)
    {       
        if ($this->_data===null)
        {           
            $this->_data=$this->getData();                        
        }    
        return isset($this->_data[$ns][$name])?$this->_data[$ns][$name]:$default;
    }
    
    function hasDataFromFieldname($ns,$name)
    {       
        if ($this->_data===null)
        {           
            $this->_data=$this->getData();                        
        }    
        return isset($this->_data[$ns][$name]);
    }
    
    static function loadSchema($site=null)
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                          
            ->setQuery("SHOW COLUMNS FROM ".CustomerMeetingForms::getTable()." WHERE Field NOT IN('id','meeting_id','data','is_processed','created_at','updated_at');")
            ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();      
        $cols=array();        
        while ($col=$db->fetchRow())
        {                   
                $cols[]=$col[0];
        }               
        return $cols;
    }        
       
    
    static function updateSchema($modified_fields,$site=null)
    {             
        // Get actual schema in DB
        $cols=self::loadSchema($site); 
        $query=array();       
        foreach ($modified_fields as $field)
        {                              
           if (($key=array_search($field->getPreviousNameForDatabase(),$cols))!==false)
           {                    
                $query[]=" CHANGE `".$field->getPreviousNameForDatabase()."` `".$field->getNameForDatabase()."` ".$field->getTypeForDatabase();                      
                $cols[$key]=$field->getNameForDatabase();
           }
           elseif (in_array($field->getNameForDatabase(),$cols))
           {
                $query[]=" CHANGE `".$field->getNameForDatabase()."` `".$field->getNameForDatabase()."` ".$field->getTypeForDatabase();  
           }                        
        }                                 
        if ($query)
        {    
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array())                          
                ->setQuery("ALTER TABLE ".CustomerMeetingForms::getTable()." ".implode(",",$query).";")
                ->makeSiteSqlQuery($site);          
        }     
         // Fields to create
        self::createFields($cols,$site);    
        self::createParameters($site);   
    }  
    
    static function updateData($modified_parameters,$site=null)
    {      
        foreach ($modified_parameters as $formfield_i18n)
        {
            $old=unserialize($formfield_i18n->getPropertyChanged('parameters'));
            $new=$formfield_i18n->getParameters();  
            $formfield_i18n->choices=array();
            if (isset($old['choices']))
            {
               foreach ($new['choices'] as $key=>$choice)
               {                 
                   if ($choice==$old['choices'][$key])
                       continue;
                   $formfield_i18n->choices[]=array('old'=>$old['choices'][$key],'new'=>$choice);
               }    
            }               
        }        
        foreach ($modified_parameters as $formfield_i18n)
        {              
           foreach ($formfield_i18n->choices as $choice)
           {                  
              $db=mfSiteDatabase::getInstance()           
                ->setParameters(array())                          
                ->setQuery("UPDATE ".CustomerMeetingForms::getTable()." SET `".$formfield_i18n->getFormField()->getNameForDatabase()."`=".
                            " REPLACE(`".$formfield_i18n->getFormField()->getNameForDatabase()."`,'".$choice['old']."','".$choice['new']."')".                         
                         ";")
                ->makeSiteSqlQuery($site);              
           }
        }    
    }        

    protected static function createFields($cols=array(),$site=null)
    {         
         $query=array();                       
         $fields=array();
         foreach (CustomerMeetingFormUtils::getFieldsForSchema($site) as $field)
         {            
             if (in_array($field->getNameForDatabase(),$fields))  // Remove duplicate
                 continue;
             $fields[]=$field->getNameForDatabase();
             if (in_array($field->getNameForDatabase(),$cols))
                 continue;             
             $query[]=" ADD `".$field->getNameForDatabase()."` ".$field->getTypeForDatabase()." AFTER `data`";  
         }             
        if ($query)
        {    
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array())                          
                ->setQuery("ALTER TABLE ".CustomerMeetingForms::getTable()." ".implode(",",$query).";")
                ->makeSiteSqlQuery($site);          
        }
       // echo "<pre>"; var_dump($fields); echo "</pre>"; 
        $cache=self::getSchemaCache($site);             
        $cache->putContent(serialize($fields)); 
    }        
    
    protected static function createParameters($site=null)
    {
        $parameters=array();
        $forms=CustomerMeetingFormUtils::getFormsForParameters($site);
        foreach ($forms as $form)
        {
            foreach ($form->getFormfields() as $field)
            {
                $parameters[$form->get('name')][$field->get('name')]=$field->getI18n()->getParameters();
            }    
        }   
        $cache=self::getParametersCache($site);
        $cache->putContent(serialize($parameters));                 
    }
    
    static function updateSchemaFromForm($form)
    {                
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('old'=>$form->getPropertyChanged('name')))                          
            ->setQuery("SHOW COLUMNS FROM ".CustomerMeetingForms::getTable()." WHERE Field NOT IN('id','meeting_id','data','created_at','updated_at') AND Field LIKE '{old}%%%%';")
            ->makeSiteSqlQuery($form->getSite()); 
        if (!$db->getNumRows())
            return array();      
        $queries=array();    
        $fields=array();
        while ($col=$db->fetchRow())
        {     
           $fields[]=$col[0];
           $queries[]=" CHANGE `".$col[0]."` `".str_replace($form->getPropertyChanged('name'),$form->get('name'),$col[0])."` ".$col[1];  
        }
        if ($queries)
        {    
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array())                          
                ->setQuery("ALTER TABLE ".CustomerMeetingForms::getTable()." ".implode(",",$queries).";")
                ->makeSiteSqlQuery($form->getSite());          
        }
        self::updateCache($form->getSite());    
    }
    
    static function buildSchema($site=null)
    {
        self::createFields(self::loadSchema($site),$site); 
        self::createParameters($site); 
    } 
    
    static function buildData($site=null)
    {
        $cache=self::getSchemaCache($site);
        if (!$cache->isExist())        
            self::buildSchema($site);        
       // get all forms data form + formfield + formfieldI18n (for parameters)
       // Test if cache exists if no create it - build schema                  
        $parameters=unserialize(self::getParametersCache($site)->getContent());      
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())
            ->setQuery("SELECT * FROM ".self::getTable()." WHERE is_processed='NO' LIMIT 0,300;")
            ->makeSiteSqlQuery($site);
        if (!$db->getNumRows())
            return 0;
        $items=array();
        while ($item=$db->fetchObject('CustomerMeetingForms')) 
        {
            $item->site=$site;
            $items[]=$item->loaded();
        }
        foreach ($items as $item)
        {            
            $item->setDataInFields($item->getData(),$parameters); 
            $item->set('is_processed','YES');
            $item->save();
         //  echo "<pre>"; var_dump($item); echo "</pre>";
        }    
        // count the rest of data to be processed
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())
            ->setQuery("SELECT count(id) FROM ".self::getTable()." WHERE is_processed='NO';")
            ->makeSiteSqlQuery($site);
        $row=$db->fetchRow();
        return $row[0];
    } 
    
    static protected function updateCache($site=null)
    {        
        $cache=self::getSchemaCache($site);             
        $cache->putContent(serialize(self::loadSchema($site))); 
    } 
    
    function getDataI18n()
    {
       static $forms=null;
       $values=$this->getData();      
       if ($forms===null)
           $forms=CustomerMeetingFormUtils::getSchemaFormsWithParameters($this->getSite());       
       foreach ($values as $form_name=>$formfields)
       {
           foreach ((array)$formfields as $formfield_name=>$formfield)
           {    
              if (!isset($forms[$form_name]->formfields[$formfield_name])) 
                  continue;             
               $choices=$forms[$form_name]->formfields[$formfield_name]->getI18n()->getParameter('choices');             
               if (!$choices)
                   continue;                                  
                foreach ((array)$values[$form_name][$formfield_name] as $value)                        
                    $values[$form_name][$formfield_name]=$choices[$value];                                                                        
           }         
       }         
       return $values;
    }
    
    function getDataI18nForDocument()
    {
       $values=$this->getData();            
       $forms=CustomerMeetingFormUtils::getSchemaFormsWithParameters($this->getSite());       
       foreach ($values as $form_name=>$formfields)
       {
           foreach ((array)$formfields as $formfield_name=>$formfield)
           {    
              if (!isset($forms[$form_name]->formfields[$formfield_name])) 
                  continue;             
               $choices=$forms[$form_name]->formfields[$formfield_name]->getI18n()->getParameter('choices');             
               if (!$choices)
                   continue;                                  
                foreach ((array)$values[$form_name][$formfield_name] as $value)  
                {                                                                                                               
                    $values[$form_name][$formfield_name]= new CustomerMeetingExportFormField(array('text'=>$choices[$value],'value'=>$value));
                }                    
           }         
       }                      
       return $values;
    }
    
    
     function getDataI18nForDocumentPdf()
    {
       $values=$this->getData();            
       $forms=CustomerMeetingFormUtils::getSchemaFormsWithParameters($this->getSite());       
       foreach ($values as $form_name=>$formfields)
       {
           foreach ((array)$formfields as $formfield_name=>$formfield)
           {    
               if (!isset($forms[$form_name]->formfields[$formfield_name])) 
                  continue;    
               if (in_array($forms[$form_name]->formfields[$formfield_name]->get('type'),array('integer','string','text')))
               {                   
                   $values[$form_name][$formfield_name]=new CustomerMeetingExportStringFormField($values[$form_name][$formfield_name]);                                      
                   $values[$form_name][$formfield_name."_exists"]=(string)$values[$form_name][$formfield_name]?"1":"0";                                               
                   $values[$form_name][$formfield_name."_sup_1"]=intval((string)$values[$form_name][$formfield_name]) > 1?$values[$form_name][$formfield_name]:""; 
                   continue;
               }                  
               $choices=$forms[$form_name]->formfields[$formfield_name]->getI18n()->getParameter('choices');             
                if (!$choices)
                    continue;
                foreach ((array)$values[$form_name][$formfield_name] as $value)  
                {                                          
                    $values[$form_name][$formfield_name]= new CustomerMeetingExportFormField(array('text'=>$choices[$value],'value'=>$value));
                }                    
           }         
       }         
       return new mfArray($values);
    }
    
    
    static function getFormsByMeetings($meetings)
    {
        $site=$meetings->getSite();
        $ids=array();
        $collection=new CustomerMeetingFormsCollection(null,$site);
        foreach ($meetings as $meeting)
            $ids[]=$meeting->get('id');
        $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT * FROM ".self::getTable()." WHERE meeting_id IN('".implode("','",$ids)."');")
            ->makeSiteSqlQuery($site);
         if (!$db->getNumRows())
             return $collection;                  
        while ($item=$db->fetchObject('CustomerMeetingForms'))
        {
            $collection[]=$item->setSite($site)->loaded();
        }        
        return $collection;
    }
    
      static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".CustomerMeetingForms::getTable().";")               
                ->makeSiteSqlQuery($site); 
    }
    
    
    static function getDefaultValues($site=null)
    {
       return self::$default_values=self::$default_values===null?CustomerMeetingFormUtils::getDefaultValues($site):self::$default_values;
    }
    
    function setDefaultsForExport($data=array())
    {                  
        foreach (self::getDefaultValues($this->getSite()) as $form_name=>$formfields)
       {
           foreach ($formfields as $formfield_name=>$formfield)
           {
               if (isset($data[$form_name][$formfield_name]))
                  continue;                
               $data[$form_name][$formfield_name]=self::$default_values[$form_name][$formfield_name];
            //   $data[$form_name]=array($formfield_name=>self::$default_values[$form_name][$formfield_name]);                                
           }            
       }        
       return $data;
    }
    
    
    static function getFormsSchema($site=null)
    {
       return self::$forms_schema=self::$forms_schema===null?CustomerMeetingFormUtils::getSchemaFormsWithParameters($site):self::$forms_schema;
    }
    
    function getDataI18nForExport()
    {        
       $values=$this->setDefaultsForExport($this->getCensoredData()->toArray());      
        
       $forms= self::getFormsSchema($this->getSite());
       
       foreach ($values as $form_name=>$formfields)
       {
           foreach ((array)$formfields as $formfield_name=>$formfield)
           {                                 
              if (!isset($forms[$form_name]->formfields[$formfield_name])) 
                  continue;             
               $choices=$forms[$form_name]->formfields[$formfield_name]->getI18n()->getParameter('choices');             
               if (!$choices)
                   continue;                                  
                foreach ((array)$values[$form_name][$formfield_name] as $value)                        
                    $values[$form_name][$formfield_name]=$choices[$value];                                                                        
           }         
       }         
       return $values;
    }
    
     function getMeeting()
    {
        if ($this->_meeting_id===null)
        {              
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());           
        }    
        return $this->_meeting_id;
    }
    
    function getHoldI18n()
    {
        return __($this->get('is_hold')); //,array(),'messages','customers_contracts');
    }
    
    function isHold()
    {
        return $this->get('is_hold')=='YES';
    }
    
    function setHold()
    {
        $this->set('is_hold','YES');
        return $this;
    }
    
    function setUnhold()
    {
        $this->set('is_hold','NO');
        return $this;
    }
    
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
     function hasContract()
    {
        return (boolean)$this->get('contract_id');
    }
    
    function getContract()
    {
        if ($this->_contract_id===null)
        {              
            $this->_contract_id=new CustomerContract($this->get('contract_id'),$this->getSite());           
        }    
        return $this->_contract_id; 
    }
    
    function getCustomer()
    {
        if ($this->hasMeeting())
            return $this->getMeeting ()->getCustomer();
        return $this->getContract()->getCustomer();
    }
    
    
    static function getFormsByContracts(CustomerContractCollection $contracts)
    {
        $site=$contracts->getSite();
        $ids=new mfArray($contracts->getKeys());       
        $collection=new CustomerMeetingFormsCollection(null,$contracts->getSite());     
        $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id IN('".$ids->implode("','")."');")
            ->makeSiteSqlQuery($contracts->getSite());
         if (!$db->getNumRows())
             return $collection;                  
        while ($item=$db->fetchObject('CustomerMeetingForms'))
        {
            $collection[]=$item->setSite($contracts->getSite())->loaded();
        }        
        return $collection;
    }
    
    
    static function getFormsForDocumentForContracts(mfAction $action)
    {        
        foreach (self::getFormsByContracts($action->getParameter('contracts')) as $form)
        {
           if (isset($action->contracts[$form->get('contract_id')]))
           {               
               $action->contracts[$form->get('contract_id')]['contract']['forms']=$form->getDataI18nForDocument();
           }        
        }        
    }
    
    static function getNumberOfFormsAvailable($site=null)
    {
         $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT * FROM ".self::getTable().
                       " INNER JOIN ".self::getOuterForJoin('meeting_id').
                      ";")
            ->makeSiteSqlQuery($site);
         $row=$db->fetchRow();
         return $row[0];
    }
    
    static function getNumberOfContractNotAffected($site=null)
    {
        /*
         * SELECT * FROM `t_customers_meeting_forms`
INNER JOIN t_customers_meeting ON t_customers_meeting.id =t_customers_meeting_forms.meeting_id
LEFT JOIN t_customers_contract ON t_customers_contract.meeting_id=t_customers_meeting.id
WHERE t_customers_contract.meeting_id IS NOT NULL AND t_customers_meeting_forms.contract_id IS NULL
         */
        $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT count(*) FROM ".self::getTable().
                       " INNER JOIN ".self::getOuterForJoin('meeting_id').
                       " LEFT JOIN ".CustomerContract::getTable()." ON ".CustomerContract::getTableField('meeting_id')."=".CustomerMeeting::getTableField('id').
                       " WHERE ".CustomerContract::getTableField('meeting_id')." IS NOT NULL AND ".
                            self::getTableField('contract_id')." IS NULL ".
                      ";")
            ->makeSiteSqlQuery($site);
     //   echo $db->getQuery();
         $row=$db->fetchRow();
         return intval($row[0]); 
    }        
    
     static function getNumberOfDouble($site=null)
    {
        /*
         SELECT *,COUNT(contract_id) AS nbr_doublon FROM `t_customers_meeting_forms` GROUP BY contract_id HAVING COUNT(contract_id) > 1
         */
        $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT COUNT(contract_id) AS nbr_doublon FROM ".self::getTable().
                       " GROUP BY contract_id HAVING COUNT(contract_id) > 1 ".
                      ";")
            ->makeSiteSqlQuery($site);
         $row=$db->fetchRow();
         return intval($row[0]); 
    }     
    
    static function setAffectMissingContracts($site=null)
    {
        /*
         UPDATE t_customers_meeting_forms
INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_customers_meeting_forms.meeting_id
SET t_customers_meeting_forms.contract_id = t_customers_contract.id
WHERE t_customers_meeting_forms.contract_id IS NULL
         */
         $db=mfSiteDatabase::getInstance()            
            ->setQuery("UPDATE ".self::getTable().                     
                       " INNER JOIN ".CustomerContract::getTable()." ON ".CustomerContract::getTableField('meeting_id')."=".self::getTableField('meeting_id').
                       " SET ".self::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                       " WHERE ".self::getTableField('contract_id')." IS NULL ".
                      ";")
            ->makeSiteSqlQuery($site);
      //   echo $db->getQuery();
    }
   
    
    function setDataFromNamespaceAndName($ns,$name,$value)
    {
        $data= unserialize($this->data);
        $data[$ns][$name]=$value;
        $this->set('data',serialize($data));
        return $this;
    }  
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new CustomerCommentSettings(null,$this->getSite()):$this->settings;
    }
    
    
    function getCensoredData()
    {               
        $data=$this->getData1();     
       
        
        foreach (CustomerMeetingFormUtils::getInputFormFields() as $form_name=>$form_data)
        {                
            foreach ($form_data as $name=>$value)
            {              
                if (!isset($data[$form_name][$name]))
                    continue;                 
                $data[$form_name][$name]=$this->getSettings()->escapeText($data[$form_name][$name]);  
            }    
        }
        return $data;
    }
    
    function setCensoredData($data)
    {                            
        foreach (CustomerMeetingFormUtils::getInputFormFields() as $form_name=>$form_data)
        {                
            foreach ($form_data as $name=>$value)
            {              
                if (!isset($data[$form_name][$name]))
                    continue;                 
                $data[$form_name][$name]=$this->getSettings()->escapeText($data[$form_name][$name]);  
            }    
        }     
        return $data;
    }
    
    static function updateContract($site = null) {
        
        $db = mfSiteDatabase::getInstance()
                ->setQuery("UPDATE " . self::getTable() .
                        " INNER JOIN " . CustomerMeeting::getTable() . " ON " . CustomerMeeting::getTableField('id') . "=" . self::getTableField('meeting_id') .
                        " INNER JOIN " . CustomerContract::getTable() . " ON " . CustomerContract::getTableField('meeting_id') . "=" . CustomerMeeting::getTableField('id') .
                        " SET " . self::getTableField('contract_id') . "=" . CustomerContract::getTableField('id') .
                        " WHERE " . self::getTableField('contract_id') . " IS NULL " .
                        ";")
                ->makeSiteSqlQuery($site);
           //echo $db->getQuery();
    }
    
    function getDataI18nForDocumentApi()
    {
       $values=$this->getData();            
       $forms=CustomerMeetingFormUtils::getSchemaFormsWithParameters($this->getSite());       
       foreach ($values as $form_name=>$formfields)
       {
           foreach ((array)$formfields as $formfield_name=>$formfield)
           {    
              if (!isset($forms[$form_name]->formfields[$formfield_name])) 
                  continue;             
               $choices=$forms[$form_name]->formfields[$formfield_name]->getI18n()->getParameter('choices');             
               if (!$choices)
                   continue;                                  
                foreach ((array)$values[$form_name][$formfield_name] as $value)  
                {                                                                                                               
                    $values[$form_name][$formfield_name]=(string) (new CustomerMeetingExportFormField(array('text'=>$choices[$value],'value'=>$value)));
                }                    
           }         
       }                      
       return $values;
    }
    
    
    function toArrayForHook()
    {
        if ($this->to_array_for_hook===null)
        {
            $this->to_array_for_hook=new mfArray($this->getDataI18nForDocumentApi());
           // $this->to_array_for_hook->add($this->toValues(['id','contract_id','meeting_id']));
        }    
        return $this->to_array_for_hook;
    }
    
}
