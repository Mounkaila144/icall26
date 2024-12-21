<?php

class CustomerMeetingFormUtilsBase  {
     
     static function getVisibleForms($site=null)
    {               
       $lang=mfContext::getInstance()->getUser()->getCountry();
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id').
                       " WHERE ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'".                      
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($items=$db->fetchObjects()) 
        {                       
            $forms[$items->getCustomerMeetingForm()->get('id')]=$items->getCustomerMeetingForm()->set('form_i18n',$items->getCustomerMeetingFormI18n());           
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".                              
                                " AND ".CustomerMeetingFormfield::getTableField('is_visible')."='YES'".
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n()); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
      //  var_dump($forms);
        return $forms;
    }
    
    static function getDefaultValues($site=null)
    {
        $values=array();        
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormfield'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " INNER JOIN ".CustomerMeetingFormfield::getInnerForJoin('form_id').         
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        while ($items=$db->fetchObjects()) 
        {
          //  echo "<pre>"; var_dump($items->getCustomerMeetingFormfield()); echo "</pre>"; 
            if (!isset($values[$items->getCustomerMeetingForm()->get('name')]))
                $values[$items->getCustomerMeetingForm()->get('name')]=array();
            if (!isset($values[$items->getCustomerMeetingForm()->get('name')][$items->getCustomerMeetingFormfield()->get('name')]))
               $values[$items->getCustomerMeetingForm()->get('name')][$items->getCustomerMeetingFormfield()->get('name')]=$items->getCustomerMeetingFormfield()->get('default'); 
            //[$items->getCustomerMeetingFormField()->get('name')]='A';
        }
        return $values;
    }
    
    
     static function getExportableForms($site=null)
    {        
       $lang=mfContext::getInstance()->getUser()->getCountry();
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id').
                       " WHERE ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'".                      
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($items=$db->fetchObjects()) 
        {                       
            $forms[$items->getCustomerMeetingForm()->get('id')]=$items->getCustomerMeetingForm()->set('form_i18n',$items->getCustomerMeetingFormI18n());           
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".                              
                                " AND ".CustomerMeetingFormfield::getTableField('is_exportable')."='YES'".
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n()); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
      //  var_dump($forms);
        return $forms;
    }
    
    static function getForms($site=null)
    {        
       $lang=mfContext::getInstance()->getUser()->getCountry();
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id').
                       " WHERE ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'".                      
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($items=$db->fetchObjects()) 
        {                       
            $forms[$items->getCustomerMeetingForm()->get('id')]=$items->getCustomerMeetingForm()->set('form_i18n',$items->getCustomerMeetingFormI18n());           
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".                               
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n()); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
      //  var_dump($forms);
        return $forms;
    }
    
    
    /* 
     * BUG papeco forms
     */
    static protected function replaceName($name)
    {        
        $name=trim(str_replace("?","",$name));
        $clean=strtoupper(preg_replace("/[^A-Z0-9_]/i","_", mfTools::I18N_noaccent($name))); 
        return $clean;
    }
    
    static protected function processSituation($values,&$destination)
    {
       $destination['SITUATION']=array();
        foreach ($values as $name=>$value)
        {
            $destination['SITUATION'][self::replaceName($name)]=$value;
        }   
    }
    
    static protected function processHabitation($values,&$destination)
    {
       $destination['HABITATION']=array();
        foreach ($values as $name=>$value)
        {
            $destination['HABITATION'][self::replaceName($name)]=$value;
        }  
    }
    
    static protected function processIsolation($values,&$destination)
    {
        $destination['ISOLATION']=array();
        foreach ($values as $name=>$value)
        {
            $destination['ISOLATION'][self::replaceName($name)]=$value;
        }    
    }
    
    protected function processUpdateForm($forms)
    {
         $source=$forms->getData();
       //    echo "<pre>"; var_dump($forms->getData()); echo "</pre>";    
         $destination=array();
         foreach ($source as $name=>$values)
         {
             if ($name=='SITUATION')
             {
                 self::processSituation($values,$destination);
             } 
             elseif ($name=='HABITATION')
             {
                 self::processHabitation($values,$destination);
             } 
             elseif ($name=='ISOLATION')
             {
                 self::processIsolation($values,$destination);
             } 
         }  
         $forms->setData($destination);
         $forms->save(); 
        //  echo "<pre>"; var_dump($destination); echo "</pre>";  
    }        
    static function processUpdate($meeting)
    {
         $forms= new CustomerMeetingForms($meeting,$meeting->getSite()); 
         if ($forms->isNotLoaded())
             return ;       
         self::processUpdateForm($forms);       
    } 
    
    static function processForms($site=null)
    {
       $db=mfSiteDatabase::getInstance()           
            ->setParameters()                        
            ->setQuery("SELECT * FROM ".CustomerMeetingFormfield::getTable().";")
            ->makeSiteSqlQuery($site);
        $collection=new CustomerMeetingFormfieldCollection(null,$site);
        while ($item=$db->fetchObject('CustomerMeetingFormfield')) 
        {       
            $item->site=$site;   
            $item->loaded();
            $item->set('name',self::replaceName($item->get('name')));       
          //  echo "Name=".$item->get('name')."<br/>";
            $collection[]=$item;
        }
        $collection->save();
       // var_dump($collection);
         $db=new mfSiteDatabase();          
         $db->setParameters()                        
            ->setQuery("SELECT * FROM ".CustomerMeetingForms::getTable().";") // WHERE meeting_id='364';")
            ->makeSiteSqlQuery($site);
        while ($item=$db->fetchObject('CustomerMeetingForms')) 
        {
             $item->site=$site;
             $item->loaded();
             self::processUpdateForm($item);
        }
    }
   /**********************************************************************************/ 
    
    static function getPositions($site=null)
    {
       $lang=mfContext::getInstance()->getUser()->getCountry();
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id').
                       " WHERE ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'".                      
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($items=$db->fetchObjects()) 
        {                       
            $forms[$items->getCustomerMeetingForm()->get('id')]=$items->getCustomerMeetingForm()->set('form_i18n',($items->hasCustomerMeetingFormI18n()?$items->getCustomerMeetingFormI18n():__('----')));           
        }  
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',($items->hasCustomerMeetingFormfieldI18n()?$items->getCustomerMeetingFormfieldI18n():__('----'))); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
        return $forms;
    } 
    
    static function checkForms($forms,$site=null)
    {        
         if (empty($forms))
            return true;         
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                         
            ->setQuery("SELECT id FROM ".CustomerMeetingForm::getTable().                                                                 
                       " WHERE ".CustomerMeetingForm::getTableField('id')." IN(".implode(",",$forms).")".                      
                       ";")
            ->makeSiteSqlQuery($site);
         if (!$db->getNumRows())
            return false; 
        while ($row=$db->fetchArray()) 
        {
            if (($key=array_search($row['id'],$forms))!==false)
                unset($forms[$key]);      
        }
        return empty($forms);
    } 
    
    static function checkFormFields($formfields,$site=null)
    {        
         if (empty($formfields))
            return true;                  
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                         
            ->setQuery("SELECT id FROM ".CustomerMeetingFormField::getTable().                                                                 
                       " WHERE ".CustomerMeetingFormField::getTableField('id')." IN(".implode(",",$formfields).")".                      
                       ";")
            ->makeSiteSqlQuery($site);
         if (!$db->getNumRows())
            return false; 
        while ($row=$db->fetchArray()) 
        {
            if (($key=array_search($row['id'],$formfields))!==false)
                unset($formfields[$key]);      
        }
        return empty($formfields);
    } 
    
   
    static function updatePositionForFormsAndFormFields($forms,$site=null)
    {
       // echo "<pre>"; var_dump($forms); echo "</pre>";     
       // return ;
        $db=mfSiteDatabase::getInstance();  
        $form_position=1;
        foreach ($forms as $form)
        {
             $db->setParameters(array('form_id'=>$form['id'],'position'=>$form_position++))   
               ->setQuery("UPDATE ".CustomerMeetingForm::getTable()." SET position={position}".                                                     
                       " WHERE ".CustomerMeetingForm::getTableField('id')."={form_id}".                      
                       ";")  
               ->makeSiteSqlQuery($site);
             $formfield_position=1;
             foreach ($form['formfields'] as $field)
             {                
                 $db->setParameters(array('field_id'=>$field,
                                          'form_id'=>$form['id'],
                                          'position'=>$formfield_position++))   
                    ->setQuery("UPDATE ".CustomerMeetingFormField::getTable()." SET position={position},form_id={form_id}".                                                     
                            " WHERE ".CustomerMeetingFormField::getTableField('id')."={field_id}".                      
                            ";")  
                    ->makeSiteSqlQuery($site);
             }               
        }                
    }
           
    
    static function getFieldsForSchema($site=null)
    {
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                         
            ->setQuery("SELECT * FROM ".CustomerMeetingForm::getTable().";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();  
        $fields=array();
        while ($item=$db->fetchObject('CustomerMeetingForm')) 
        {                       
            $item->site=$site;
            $forms[$item->get('id')]=$item->loaded();
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                          
            ->setQuery("SELECT * FROM ".CustomerMeetingFormfield::getTable().                                                                 
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".                     
                       ";")
            ->makeSiteSqlQuery($site);
        while ($item=$db->fetchObject('CustomerMeetingFormfield')) 
        {            
            if (isset($forms[$item->get('form_id')]))
            {    
                $item->site=$site;        
                $item->set('form_id',$forms[$item->get('form_id')]);
                $fields[$item->get('id')]=$item->loaded();
            }
        }                      
        return $fields;
    }    
    
    
    static function getFormsForParameters($site=null)
    {        
         $lang=mfContext::getInstance()->getUser()->getCountry();
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                          
            ->setQuery("SELECT * FROM ".CustomerMeetingForm::getTable().                                                             
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($item=$db->fetchObject('CustomerMeetingForm')) 
        {            
            $item->site=$site;            
            $forms[$item->get('id')]=$item->loaded();           
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n()); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
      //  var_dump($forms);
        return $forms;
    }
    
    static function getFormFieldsForChoice($site=null)
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                        
            ->setQuery("SELECT * FROM ".CustomerMeetingFormfield::getTable().  
                       " WHERE type='choice'".
                       ";")
            ->makeSiteSqlQuery($site);
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($item=$db->fetchObject('CustomerMeetingFormfield')) 
        {                            
            $forms[$item->get('id')]=$item->get('id');           
        }           
        return $forms;
    }
    
    static function getFormFieldsNameFromFormFields($formfields,$site=null)
    {
        if (empty($formfields))
            return array();       
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingForm'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').
                       " WHERE ".CustomerMeetingFormfield::getTableField('id')." IN(".implode(",",$formfields).")".                      
                       ";")
            ->makeSiteSqlQuery($site);
          if (!$db->getNumRows())
            return array();
        $list=array();
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield();
            $item->set('form_id',$items->getCustomerMeetingForm());                    
            $list[$item->get('id')]=$item->getNameForDatabase();
        }   
        return $list;
    }  
    
    static function getValuesFromFormfieldForSelect($formfield,$site=null)
    {
        $lang=mfContext::getInstance()->getUser()->getCountry(); 
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('formfield_name'=>$formfield,'lang'=>$lang))                         
            ->setQuery("SELECT ".CustomerMeetingForms::getTableFieldEscape($formfield)." FROM ".CustomerMeetingForms::getTable().                                                                                                            
                       " GROUP BY ".CustomerMeetingForms::getTableFieldEscape($formfield).
                       ";")
            ->makeSiteSqlQuery($site);
          if (!$db->getNumRows())
            return array();
        $list=array();
         while ($row=$db->fetchArray()) 
        {            
           $list[$row[$formfield]]=$row[$formfield];
        }           
        return $list;
    }    
    
    static function getFormFieldI18nFromFormfieldsForSelect($formfields,$site=null)
    {
        $lang=mfContext::getInstance()->getUser()->getCountry(); 
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('id')." IN(".implode(",",array_keys($formfields)).")".                       
                       ";")
            ->makeSiteSqlQuery($site);
        $list=array();
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n());                
            $list[$item->get('id')]=$items->getCustomerMeetingFormfieldI18n()->get('request');
        }         
        return $list;
    }       
    
    static function loadFormsDataFromPager($pager)
    {
        if (!$pager)
            return ;
        $meetings=$pager->getItems();
        if (empty($meetings))
            return ;
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                        
            ->setQuery("SELECT * FROM ".CustomerMeetingForms::getTable().                                                                  
                       " WHERE ".CustomerMeetingForms::getTableField('meeting_id')." IN(".implode(",",array_keys($meetings)).")".                       
                       ";")
            ->makeSiteSqlQuery($pager->getSite());
         if (!$db->getNumRows())
            return ;
         while ($item=$db->fetchObject('CustomerMeetingForms')) 
        {                                        
            $meetings[$item->get('meeting_id')]->forms=$item->setSite($pager->getSite())->loaded();         
        } 
    }
    
    static function getFormFieldI18n($formfield,ConditionsQuery $where,$site=null)
    {
        $lang=mfContext::getInstance()->getUser()->getCountry(); 
        $db=mfSiteDatabase::getInstance()
                ->setParameters($where->getParameters())
                ->setParameter('lang',$lang)
                ->setQuery("SELECT ".CustomerMeetingForms::getTableField('id').",".CustomerMeetingForms::getTableFieldEscape($formfield)." FROM ".CustomerMeetingForms::getTable().
                           " LEFT JOIN ".CustomerMeetingForms::getOuterForJoin('meeting_id').
                           $where->getWhere(). 
                           " GROUP BY ".CustomerMeetingForms::getTableFieldEscape($formfield).                                                                              
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $list=array();
        while ($item=$db->fetchObject('CustomerMeetingForms'))
        {                      
           $list[$item->get($formfield)]= $item->setSite($site)->loaded();
        }               
        return $list;
    }   
    
     static function getFormFieldI18nFromFormfieldsForIn($formfields,$site=null)
    {
        $lang=mfContext::getInstance()->getUser()->getCountry(); 
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n','CustomerMeetingForm'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().              
                       " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('id')." IN(".implode(",",array_keys($formfields)).")".                       
                       ";")
            ->makeSiteSqlQuery($site);
        $list=array();
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()
                    ->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n())
                    ->set('form_id',$items->getCustomerMeetingForm());   
            $list[$item->get('id')]=$item;
        }         
        return $list;
    }       
    
    
    static function getChoiceForms($site=null)
    {        
       $lang=mfContext::getInstance()->getUser()->getCountry();
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id').
                       " WHERE ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'".                      
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($items=$db->fetchObjects()) 
        {                       
            $forms[$items->getCustomerMeetingForm()->get('id')]=$items->getCustomerMeetingForm()->set('form_i18n',$items->getCustomerMeetingFormI18n());           
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".
                                " AND ".CustomerMeetingFormfield::getTableField('type')."='choice'".
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n()); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
      //  var_dump($forms);
        return $forms;
    }
    
    static function getSchemaFormsWithParameters($site=null)
    {        
       $lang=mfContext::getInstance()->getUser()->getCountry();     
       $forms=array();
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>$lang))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n','CustomerMeetingForm'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable(). 
                       " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').
                       " INNER JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id'). //" AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                     
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
           if (!isset($forms[$items->getCustomerMeetingForm()->get('name')]))
                $forms[$items->getCustomerMeetingForm()->get('name')]=$items->getCustomerMeetingForm();           
           $formfield=$items->getCustomerMeetingFormfield();              
           $formfield->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n());
           $forms[$items->getCustomerMeetingForm()->get('name')]->formfields[$formfield->get('name')]=$formfield;                    
        }            
        return $forms;
    }
    
    static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".CustomerMeetingForm::getTable().";")               
                ->makeSiteSqlQuery($site); 
        $db->setQuery("DELETE FROM ".CustomerMeetingFormField::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("DELETE FROM ".CustomerMeetingFormFieldI18n::getTable().";")               
                ->makeSiteSqlQuery($site); 
    }
    
    static function getFormsI18nForSelect($site=null)
    {
        $values=new mfArray();
        foreach (self::getForms($site) as $form)
        {           
           foreach ($form->getFormfields() as $field)
           {
               $values[$form->get('name').".".$field->get('name')]=$form->getI18n()->get('value').":".$field->getI18n()->get('request');  
           }              
        }       
        return $values;
    }    


     static function getFormsI18nForExport($site=null)
    {
        static $values=null;
        
        if ($values===null)
        {    
            $values=new mfArray();
            foreach (self::getExportableForms($site) as $form)
            {           
               foreach ($form->getFormfields() as $field)
               {                           
                   $values[$form->get('name').".".$field->get('name')]=new CustomerMeetingFormExportModel( $form->get('name').".".$field->get('name'), $form->getI18n()->get('value').":".$field->getI18n()->get('request')); //$form->getI18n()->get('value').":".$field->getI18n()->get('request');  
               }              
            }
        }
        return $values;
    }  
    
    static function getFormsI18nForExport2($site=null)
    {
        static $values=null;
        
        if ($values===null)
        {    
            $values=new mfArray();
            foreach (self::getExportableForms($site) as $form)
            {           
               foreach ($form->getFormfields() as $field)
               {                           
                   $values["customer.meeting.forms.".$form->get('name').".".$field->get('name')]=new CustomerMeetingFormExportModel( $form->get('name').".".$field->get('name'), $form->getI18n()->get('value').":".$field->getI18n()->get('request')); //$form->getI18n()->get('value').":".$field->getI18n()->get('request');                  
               }              
            }
        }
        return $values;
    }  
    
   /* static function getFormsI18nForImport($site=null)
    {
       $forms=getFieldsForSchema($site);
      // var_dump($forms);
    } */
    
    
    static function setFormsI18nForImport($import_form,$site=null)
    {      
       foreach (self::getForms($site) as $form)
       {            
           foreach ($form->getFormfields() as $formfield)
           {            
               $import_form->setValidator($form->get('name')."-".$formfield->get('name'),$formfield->getI18n()->getValidatorForImport());
           }    
       }          
    } 
    
    static function setDataForImport($meeting,$values,$site=null)
    {
        static $schema=null;        
        if ($meeting->isNotLoaded())
            return ;
        if ($schema===null)
        {
            foreach (self::getForms($site) as $form)
            {            
                foreach ($form->getFormfields() as $formfield)
                {                                
                   $schema[$form->get('name')."-".$formfield->get('name')]=$formfield;
                }    
            }             
        }            
        $values_to_save=array();
        foreach ($schema as $name=>$formfield)
        {
           if (isset($values[$name]))
           {               
               $names=explode("-",$name);
               if ($formfield->get('type')=='choice')
               {                  
                  $values_to_save[$names[0]][$names[1]]=array_search($values[$name],$formfield->getI18n()->getChoicesForImport());                 
               }   
               else
               {    
                    $values_to_save[$names[0]][$names[1]]= mb_convert_encoding($values[$name],'UTF-8','UTF-8');               
               }
           }    
        }                   
        $extra=new CustomerMeetingForms($meeting,$site);         
        $extra->setDataFromImport($values_to_save); 
        $extra->save();       
    }                  
    
    static function getFormFieldsI18nForSelect($site=null)
    {
        static $values=null;
        if ($values===null)
        {    
            $values=new mfArray();
            foreach (self::getForms($site) as $form)
            {           
               foreach ($form->getFormfields() as $field)
               {
                   $values[$field->get('id')]=$form->getI18n()->get('value').":".$field->getI18n()->get('request');  
               }              
            }
        }
        return $values;
    }  

     static function getFormFieldValuesI18nFromFormFieldForSelect($formfield_id,$site=null)
     {
         static $formfields_i18n=array();
         
         if (!isset($formfields_i18n[$formfield_id]))
         {                
            $formfields_i18n[$formfield_id]= new CustomerMeetingFormfieldI18n(array('lang'=>mfContext::getInstance()->getUser()->getCountry(),'formfield_id'=>$formfield_id),$site);
         }                  
         return $formfields_i18n[$formfield_id]->getChoices();
     }        

     static function getFormFieldWithValuesI18nForSelect($site=null)
     {
          $values=new mfArray();
            foreach (self::getForms($site) as $form)
            {           
               foreach ($form->getFormfields() as $field)
               {
                   if ($field->get('type')=='choice')
                   { 
                     foreach ($field->getI18n()->getParameter('choices') as $index=>$choice)
                        $values[$field->getI18n()->get('id')."_".$index]=$form->getI18n()->get('value').":".$field->getI18n()->get('request')." : ".$choice;                         
                   }
               }              
            }
            return $values;
     }   



      static function getFormsI18nForService($site=null)
    {
        static $values=null;
        
        if ($values===null)
        {    
            $values=new mfArray();
            foreach (self::getExportableForms($site) as $form)
            {           
               foreach ($form->getFormfields() as $field)
               {                           
                   $values[$form->get('name').".".$field->get('name')]=new CustomerMeetingFormExportModel( $form->get('name').".".$field->get('name'), $form->getI18n()->get('value').":".$field->getI18n()->get('request'));
               }              
            }
        }
        return $values;
    }  
    
      static function getFormsI18nWithNamespaceForService($ns="",$site=null)
    {
        static $values=null;        
        if ($values===null)
        {    
            $values=new mfArray();
            foreach (self::getExportableForms($site) as $form)
            {           
               foreach ($form->getFormfields() as $field)
               {                           
                   $values[($ns?$ns.".":"").$form->get('name').".".$field->get('name')]=new CustomerMeetingFormExportModel($form->get('name').".".$field->get('name'), $form->getI18n()->get('value').":".$field->getI18n()->get('request'));
               }              
            }
        }
        return $values;
    }  
    
    
    
     static function getPartialVisibleForms($forms_to_display,$site=null)
    {               
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>mfContext::getInstance()->getUser()->getCountry()))              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " LEFT JOIN ".CustomerMeetingFormI18n::getInnerForJoin('form_id').
                       " WHERE ".CustomerMeetingFormI18n::getTableField('lang')."='{lang}'". 
                                " AND ".CustomerMeetingForm::getTableField('name')." IN('".$forms_to_display->implode("','")."')".
                       " ORDER BY ".CustomerMeetingForm::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $forms=array();        
        while ($items=$db->fetchObjects()) 
        {                       
            $forms[$items->getCustomerMeetingForm()->get('id')]=$items->getCustomerMeetingForm()->set('form_i18n',$items->getCustomerMeetingFormI18n());           
        }           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("lang"=>mfContext::getInstance()->getUser()->getCountry()))              
            ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                       " LEFT JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                       
                       " WHERE ".CustomerMeetingFormfield::getTableField('form_id')." IN(".implode(",",array_keys($forms)).")".                              
                                " AND ".CustomerMeetingFormfield::getTableField('is_visible')."='YES'".
                       " ORDER BY ".CustomerMeetingFormField::getTableField('position')." ASC".
                       ";")
            ->makeSiteSqlQuery($site);
        while ($items=$db->fetchObjects()) 
        {            
            $item=$items->getCustomerMeetingFormfield()->set('formfield_i18n',$items->getCustomerMeetingFormfieldI18n()); 
            $items->getCustomerMeetingFormfieldI18n()->set('formfield_id',$item);           
            $forms[$item->get('form_id')]->formfields[]=$item;
        }       
      //  var_dump($forms);
        return $forms;
    }
    
   
    static function setDataForContractForImport($contract,$values,$site=null)
    {
        static $schema=null;        
        if ($contract->isNotLoaded())
            return ;
        if ($schema===null)
        {
            foreach (self::getForms($site) as $form)
            {            
                foreach ($form->getFormfields() as $formfield)
                {                                
                   $schema[$form->get('name')."-".$formfield->get('name')]=$formfield;
                }    
            }             
        }            
        $values_to_save=array();
        foreach ($schema as $name=>$formfield)
        {
           if (isset($values[$name]))
           {               
               $names=explode("-",$name);
               if ($formfield->get('type')=='choice')
               {                  
                  $values_to_save[$names[0]][$names[1]]=array_search($values[$name],$formfield->getI18n()->getChoicesForImport());                 
               }   
               else
               {    
                    $values_to_save[$names[0]][$names[1]]= mb_convert_encoding($values[$name],'UTF-8','UTF-8');               
               }
           }    
        }                   
        $extra=new CustomerMeetingForms($contract,$site);         
        $extra->set('contract_id',$contract);
        $extra->setDataFromImport($values_to_save); 
        $extra->save();       
    }       
    
    
    static function setDataForContractImport(CustomerContract $contract,$values,$site=null)
    {
        static $schema=null;       
        if ($contract->isNotLoaded())
            return ;
        if ($schema===null)
        {
            foreach (self::getForms($site) as $form)
            {           
                foreach ($form->getFormfields() as $formfield)
                {                               
                    $schema[$form->get('name')."-".$formfield->get('name')]=$formfield;
                }   
            }            
        }           
        $values_to_save=array();
        foreach ($schema as $name=>$formfield)
        {
            if (isset($values[$name]))
            {              
                $names=explode("-",$name);
                if ($formfield->get('type')=='choice')
                {                 
                    $values_to_save[$names[0]][$names[1]]=array_search($values[$name],$formfield->getI18n()->getChoicesForImport());                
                }  
                else
                {   
                    $values_to_save[$names[0]][$names[1]]= mb_convert_encoding($values[$name],'UTF-8','UTF-8');              
                }
            }   
        }                  
        $extra=new CustomerMeetingForms($contract,$site);        
        $extra->setDataFromImport($values_to_save);
        $extra->save();      
    }
    
    static function getActiveFormFieldI18nFromFormfieldsForSelect($site=null)
    {
        static $list=null;
        if ($list==null)
        {    
            $list=array();
            $lang=mfContext::getInstance()->getUser()->getCountry(); 
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array("lang"=>$lang))              
                ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingForm','CustomerMeetingFormfieldI18n'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormfield::getTable().                                           
                           " INNER JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id')." AND ".CustomerMeetingFormfieldI18n::getTableField('lang')."='{lang}'".                                            
                           " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').
                           ";")
                ->makeSiteSqlQuery($site);
             if (!$db->getNumRows())
                 return $list;
            while ($items=$db->fetchObjects()) 
            {            
                $item=$items->getCustomerMeetingFormfield();
                $item->setI18n($items->getCustomerMeetingFormfieldI18n());                
                $item->set('form_id',$items->getCustomerMeetingForm());                
                $list[$item->get('id')]=$items->getCustomerMeetingFormfield();
            }
        }
        return $list;
    }  
    
    static function loadFormsDataFromContractPager(Pager $pager)
    {
        if (!$pager)
            return ;        
        if (!$pager->hasItems())
            return ;
        $keys=new mfArray($pager->getKeys());       
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                        
            ->setQuery("SELECT * FROM ".CustomerMeetingForms::getTable().                                                                  
                       " WHERE ".CustomerMeetingForms::getTableField('contract_id')." IN('".$keys->implode("','")."')".                       
                       ";")
            ->makeSiteSqlQuery($pager->getSite());
         if (!$db->getNumRows())
            return ;
         while ($item=$db->fetchObject('CustomerMeetingForms')) 
        {                      
            $pager[$item->get('contract_id')]->forms=$item->setSite($pager->getSite())->loaded();         
        } 
    }
    
    
    static function loadFormsDataFromMeetingPager(Pager $pager)
    {
        if (!$pager)
            return ;        
        if (!$pager->hasItems())
            return ;
        $keys=new mfArray($pager->getKeys());          
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                        
            ->setQuery("SELECT * FROM ".CustomerMeetingForms::getTable().                                                                  
                       " WHERE ".CustomerMeetingForms::getTableField('meeting_id')." IN('".$keys->implode("','")."')".                       
                       ";")
            ->makeSiteSqlQuery($pager->getSite());
       // echo $db->getQuery();
         if (!$db->getNumRows())
            return ;
         while ($item=$db->fetchObject('CustomerMeetingForms')) 
        {                      
            $pager[$item->get('meeting_id')]->forms=$item->setSite($pager->getSite())->loaded();         
        } 
    }
    
    
    static function getInputFormFields($site=null)
    {
        static $values=null;
        
        if ($values===null) return $values;        
        $values=array();        
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setObjects(array('CustomerMeetingForm','CustomerMeetingFormfield'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingForm::getTable().                      
                       " INNER JOIN ".CustomerMeetingFormfield::getInnerForJoin('form_id').      
                       " WHERE ".CustomerMeetingFormfield::getTableField('type')." IN('string','text') ".
                                " AND ".CustomerMeetingFormfield::getTableField('is_visible')."='YES'".
                       ";")
            ->makeSiteSqlQuery($site);   
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return $values;
        while ($items=$db->fetchObjects()) 
        {          
            if (!isset($values[$items->getCustomerMeetingForm()->get('name')]))
                $values[$items->getCustomerMeetingForm()->get('name')]=array();
            if (!isset($values[$items->getCustomerMeetingForm()->get('name')][$items->getCustomerMeetingFormfield()->get('name')]))
               $values[$items->getCustomerMeetingForm()->get('name')][$items->getCustomerMeetingFormfield()->get('name')]=true;             
        }
        return $values;
    }
    
    
    static function getFormFieldI18nFromNSandNameAndType($ns,$name,$type,$site=null)
    {
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('type'=>$type,'ns'=>$ns,'name'=>$name))                          
            ->setQuery("SELECT ".CustomerMeetingFormfieldI18n::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingForm::getTable().                      
                       " INNER JOIN ".CustomerMeetingFormfield::getInnerForJoin('form_id').      
                       " INNER JOIN ".CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id'). 
                       " WHERE ".CustomerMeetingFormfield::getTableField('type')."='{type}' AND ".
                             CustomerMeetingFormfield::getTableField('name')."='{name}' AND ".
                             CustomerMeetingForm::getTableField('name')."='{ns}'" .   
                       " LIMIT 0,1".
                       ";") 
              ->makeSiteSqlQuery($site);   
        return $db->fetchObject('CustomerMeetingFormfieldI18n')->loaded()->setSite($site);         
    }
}
