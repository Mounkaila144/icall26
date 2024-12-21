<?php

require_once dirname(__FILE__)."/Forms/MeetingStatusImportForm.class.php";
require_once dirname(__FILE__)."/Forms/MeetingStatusImportFileForm.class.php";

class MeetingStatusImport extends ImportCore {
              
    function __construct($file, $type, $site = null) {
        parent::__construct($file, $type, $site);
        if ($type=='zip')
        {    
            $this->loader=new ImportZip('MeetingStatus',$site);
            $res=$this->getLoader()->open($file);       
            if ($res=$this->getLoader()->open($file)!==true)                
                throw new mfException(__("zip file [%s] can not be opened.",basename($file)));                  
            $this->getLoader()->extract();
            $this->getLoader()->close();      
            $file=$this->getLoader()->getPath()."/status.csv";           
            $this->setPathForResources($this->getSourcePathForFiles());
        }           
        $this->import=new csvImport($file,array(),$site); 
    }               
            
    function execute() 
    {                  
        try
        {     
           $this->setForm(new MeetingStatusImportForm($this->getSourcePathForFiles(),$this->getSite()));  
           $this->verifyHeader();
           $this->initialize();          
           while ($line=$this->getImport()->fetchArray())
           {                                                      
                $this->getForm()->setDefaults($line);                
                $this->getForm()->bind($line);                  
                if ($this->getForm()->isValid())
                {      
                    $status_i18n=$this->getForm()->getStatusI18n();
                    if ($status_i18n->isLoaded())
                        $this->object_updated++;
                    else
                        $this->object_inserted++; 
                     // Foreign keys
                     
                    // Pictures                   
                    if ($this->getForm()->getValue('icon'))
                    {
                        $icon=$this->getForm()->getValue('icon');
                        $status_i18n->set('icon',$icon->getName());
                    }                      
                    $status_i18n->getCustomerMeetingStatus()->save();
                    $status_i18n->set('status_id',$status_i18n->getCustomerMeetingStatus());
                    $status_i18n->save();    
                    if ($icon)
                    {
                        $icon->copy($status_i18n->getDirectory());
                    }  
                }   
                else 
                {      
                     $errors=array();
                     foreach ($this->getForm()->getFields() as $name)
                     {                       
                        if ($this->form[$name]->hasError())
                           $errors[]=sprintf("%s: ",$name).$this->form[$name]->getError();
                     }  
                     throw new ImportException(ImportException::ERROR_IMPORT_FIELDS_ERROR,array('errors'=>$errors,'line'=>$this->current_line));                    
                } 
                $this->current_line++;      
           }
        }
        catch (ImportException $e)
        {
            throw new mfException($e->getI18nMessage());
        }   
       // var_dump($this->getMessages());
        // Warning if file has no line
        // Put number of line managed
        $this->close();
    }
       
    
    
}


