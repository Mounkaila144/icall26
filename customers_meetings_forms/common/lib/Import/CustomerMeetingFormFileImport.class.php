<?php
 
class CustomerMeetingFormFileImport  {
              
    protected $import_file=null,$site=null;
    
    function __construct(File $import_file,$site=null) {                  
        $this->import= new CustomerMeetingFormImportModel($import_file->getFile(),0,true);        
        $this->site=$site;      
    }  
    
    function getLanguage()
    {
        return mfContext::getInstance()->getUser()->getLanguage();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getImport()
    {
        return $this->import;
    }
    
    
    function getForm()
    {
        return $this->form=$this->form===null?new CustomerMeetingForm(null,$this->getSite()):$this->form;
    }
     //DELETE FROM `t_customers_meeting_formfield` WHERE form_id > 13
    function execute() 
    {                         
        try
        {          
            if ($this->getImport()->getName()!==false)
            {                                                    
                $form = new CustomerMeetingForm(null,$this->getSite());
                $form->set('name',$this->getImport()->getName())->save();
                $form_i18n = new CustomerMeetingFormI18n(null,$this->getSite());
                $form_i18n->add(array('form_id'=>$form,'lang'=>$this->getLanguage(),'value'=>$this->getImport()->getTitle()))->save(); 
              
                $collection =new CustomerMeetingFormFieldCollection(null,$this->getSite());               
                foreach ($this->getImport()->getFields()->field as $field)
                {                                
                    $formfield =new CustomerMeetingFormField(null,$this->getSite());
                    $formfield->set('form_id',$form);
                    $formfield->add($field->attributes());
                    $collection[]=$formfield;                  
                }
                $collection->save(); 
                
            
                $collection_i18n =new CustomerMeetingFormFieldI18nCollection(null,$this->getSite());
                $idx=0;
                foreach ($this->getImport()->getFields()->field as $field)
                {                                           
                    $formfield_i18n =new CustomerMeetingFormFieldI18n(null,$this->getSite());
                    $formfield_i18n->set('formfield_id',$collection->getItemByKey($idx++));
                    $formfield_i18n->set('lang',$this->getLanguage());
                    $formfield_i18n->set('request',(string)$field->i18n['request']);
                    $formfield_i18n->set('parameters',serialize(json_decode($field->i18n['parameters'],true)));
                    $collection_i18n[]=$formfield_i18n;                            
                } 
                 $collection_i18n->save(); 
            }   
            else 
            {                      
                throw new ImportException(ImportException::ERROR_IMPORT,array('errors'=>__('The Xml format is invalid.')));
            }    
        }
        catch (ImportException $e)
        {
            throw new mfException($e->getI18nMessage());
        } 
        catch (Exception $e)
        {
            throw new mfException($e->getMessage());
        } 
    }
           
}
