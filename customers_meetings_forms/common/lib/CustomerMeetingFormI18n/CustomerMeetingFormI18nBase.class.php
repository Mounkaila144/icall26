<?php


class CustomerMeetingFormI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','form_id','lang');
    protected static $foreignKeys=array('form_id'=>'CustomerMeetingForm'); // By default
    const table="t_customers_meeting_form_i18n"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['form_id']))
              return $this->loadByLangAndFormId((string)$parameters['lang'],(string)$parameters['form_id']); 
            if (isset($parameters['lang']) && isset($parameters['form']) &&  $parameters['form'] instanceof CustomerMeetingForm)
             return $this->loadByLangAndForm((string)$parameters['lang'],$parameters['form']); 
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
    
    protected function loadByLangAndFormId($lang,$form_id)
    {
       $this->set('form_id',$form_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('form_id'=>$form_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND form_id='{form_id}';")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
    protected function loadByLangAndForm($lang,$form)
    {
       $this->set('form_id',$form);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('form_id'=>$form->get('id'),"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND form_id='{form_id}';")
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
    /*  $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site); */     
    }
    
     protected function hasSibbling()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("form_id"=>$this->get('form_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE form_id={form_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
      function delete()
    {
        if (parent::delete()===false)       
            return $this;
        if (!$this->hasSibbling())
            $this->getForm()->delete();
        return $this;
    }   
     
     public function getForm()
     {         
         if (!$this->_form_id)
         {            
             $this->_form_id=new CustomerMeetingForm($this->get('form_id'),$this->getSite());
         }   
         return $this->_form_id;
     }                 
     
    function getDefaultFormfields()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('form_id'=>$this->get('form_id'),"lang"=>$this->get('lang')))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable(). 
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".
                       " WHERE form_id='{form_id}'".
                       " ORDER BY position ASC".
                       ";")
            ->makeSiteSqlQuery($this->site); 
        if (!$db->getNumRows())
            return array();
        $formfields=array();        
        while ($items=$db->fetchObjects())
        {                          
            $items->getCustomerMeetingFormfield()->set('form_id',$this->get('form_id'));
            $item=$items->getCustomerMeetingFormfieldI18n();
            $item->set('formfield_id',$items->getCustomerMeetingFormfield());           
            $formfields[]=$item->getParameters(array('name'=>$item->getFormField()->get('name'),
                          'type'=>$item->getFormField()->get('type'),                           
                          'formfield_id'=>$item->get('formfield_id'),
                          'request'=>$item->get('request'),
                          'default'=>$item->getFormField()->get('default'),
                          'is_visible'=>$item->getFormField()->get('is_visible')=='YES',
                          'is_exportable'=>$item->getFormField()->get('is_exportable')=='YES',
                          ));
            
        }                     
        return array('fields'=>$formfields,'count'=>count($formfields));
    }
    
    function updateFormFields($fields)
    {
      //  echo "<pre>"; var_dump($fields); echo "</pre>"; 
        if ($this->isNotLoaded())
            return $this;      
        $modified_fields=array();  
        $modified_parameters=array();
        $formfields=array();
        foreach ($fields as $index=>$field)
        {
            if (isset($field['formfield_id']))
               $formfields[$index]= $field['formfield_id'];
        }             
        if (empty($formfields))
        {
           $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('form_id'=>$this->get('form_id')))              
                ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
                ->setQuery("DELETE FROM ".CustomerMeetingFormfield::getTable().                       
                           " WHERE form_id='{form_id}' ".
                           ";")
                ->makeSiteSqlQuery($this->site);   
        }    
        // Delete formfield not used       
        if (!empty($formfields))
        {
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('form_id'=>$this->get('form_id')))              
                ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
                ->setQuery("DELETE FROM ".CustomerMeetingFormfield::getTable().                       
                           " WHERE form_id='{form_id}' AND ".CustomerMeetingFormfield::getTableField('id')." NOT IN('".implode("','",$formfields)."')".
                           ";")
                ->makeSiteSqlQuery($this->site); 
        }        
        if (!empty($formfields))
        {    
        // Load existing formfield used and update them
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('form_id'=>$this->get('form_id'),"lang"=>$this->get('lang')))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable(). 
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".
                       " WHERE form_id='{form_id}' AND ".CustomerMeetingFormfield::getTableField('id')." IN('".implode("','",$formfields)."')".
                       ";")
            ->makeSiteSqlQuery($this->site); 
           $list=array();
           while ($items=$db->fetchObjects())
           {
                $key=array_search($items->getCustomerMeetingFormfield()->get('id'),$formfields);               
                $items->getCustomerMeetingFormfield()->set('form_id',$this->get('form_id'));
                if ($items->hasCustomerMeetingFormfieldI18n())
                    $item=$items->getCustomerMeetingFormfieldI18n();
                else
                {    
                    $item=new CustomerMeetingFormfieldI18n(null,$this->getSite());
                    $item->set('formfield_id',$items->getCustomerMeetingFormfield()); 
                    $item->set('lang',$this->get('lang')); 
                }   
                $list[$key]=$item;                                 
           }             
           // Update them
           foreach ($list as $index=>$formfield_i18n)
           {
               $formfield_i18n->add(array(
                    'request'=>$fields[$index]['request']
               ));
               $formfield_i18n->setParameters($fields[$index]);
               if ($formfield_i18n->hasPropertyChanged('parameters'))
               {
                  $modified_parameters[]= clone $formfield_i18n;
               }                 
               $formfield_i18n->save();             
               
               //var_dump($fields[$index]);
               
               $formfield_i18n->getFormField()->add(array('name'=>$fields[$index]['name'],
                                                    'type'=>$fields[$index]['type'], 
                                                    'default'=>$fields[$index]['default'], 
                                                    'is_visible'=>$fields[$index]['is_visible'], 
                                                    'is_exportable'=>$fields[$index]['is_exportable'],                                 
                                   ));                
               if (isset($fields[$index]['widget']) && $fields[$index]['widget'])
                  $formfield_i18n->getFormField()->set('widget',$fields[$index]['widget']);
               $formfield_i18n->getFormField()->updateWidget();                            
               // Get name modif                      
               if ($formfield_i18n->getFormField()->hasPropertyChanged('name') || 
                   $formfield_i18n->getFormField()->hasPropertyChanged('type'))
               {                       
                   $modified_fields[]=clone $formfield_i18n->getFormField();
               }                 
               $formfield_i18n->getFormField()->save();             
               unset($fields[$index]); // Remove records updated
           }               
        }        
        // Insert new formfields
        foreach ($fields as $index=>$formfield)
        {
            $formfield_i18n=new CustomerMeetingFormfieldI18n(null,$this->getSite());
            $formfield_i18n->getFormField()->add(array('name'=>$formfield['name'],
                                                       'type'=>$formfield['type'],
                                                       'default'=>$fields[$index]['default'], 
                                                       'is_visible'=>$fields[$index]['is_visible'], 
                                                       'is_exportable'=>$fields[$index]['is_exportable'],                                                    
                                                       'form_id'=>$this->get('form_id')));
            if (isset($fields[$index]['widget']) && $fields[$index]['widget'])
                $formfield_i18n->getFormField()->set('widget',$fields[$index]['widget']);
            $formfield_i18n->getFormField()->updateWidget();
            $formfield_i18n->getFormField()->save();
            $formfield_i18n->add(array(
                    'request'=>$formfield['request']
               ));           
            $formfield_i18n->set('formfield_id',$formfield_i18n->getFormField()); 
            $formfield_i18n->setParameters($formfield);
            $formfield_i18n->set('lang',$this->get('lang')); 
            $formfield_i18n->save();                    
        }    
        $settings=CustomerMeetingFormsSettings::load($this->getSite());
        if ($settings->get('fields_feature')=='YES')
        {    
            CustomerMeetingForms::updateSchema($modified_fields,$this->getSite());
            CustomerMeetingForms::updateData($modified_parameters,$this->getSite());
        }
    }
    
    
   
}
