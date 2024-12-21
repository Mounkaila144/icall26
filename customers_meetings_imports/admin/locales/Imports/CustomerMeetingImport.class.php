<?php

require_once dirname(__FILE__)."/Forms/CustomerMeetingImportForm.class.php";

class CustomerMeetingImport extends ImportCore {
              
    protected $options=array(),$import_file=null,$user=null,$log_file=null,$nb_errors=0,$object_updated=0;
    
    function __construct($user,CustomerMeetingImportFile $import_file, $type='csv',$options=array()) {
        $this->user=$user;
        parent::__construct();  
        $this->import_file=$import_file;
        $this->options=array_merge($options,array('max_lines'=>50));
        $this->import=new CsvImport($import_file->getFile()->getFile(),array()); 
        $this->import->setSchema($import_file->getSchema());      
        $this->import->open();
        $this->setForm(new CustomerMeetingImportForm($this->getUser(),$import_file->getSchema()));
        $file = $this->import_file->getFileDirectory()."/". CustomerMeetingImportLogFile::getlogFileName();
        $this->log_file = new CustomerMeetingImportLogFile($file,"a+");
        
    }               
               
    
    function getUser()
    {
        return $this->user;
    }
    
    function execute() 
    {                  
        try
        {            
            if($this->getOption("mode")=="debug")
                return $this->executeForDebug();
            $this->log_file->open();
            if ($this->import_file->hasHeader())
            {    
                $this->import->readHeader();
                if($this->import_file->getLinesProcessed()==0)
                {
                    $this->log_file->writeHeader($this->import->getHeader(),array("import status"));
                }
            }    
            //$this->verifyHeader();
            $this->initialize();  
            $this->import->seek($this->import_file->getLinesProcessed());           
            $max_lines=$this->getOption('max_lines',5);                   
            while (($line=$this->getImport()->fetchArray()) &&  $max_lines--!=0)
            {                                                  
                $this->getForm()->setDefaults($line); 
                $this->getForm()->reconfigure();
                $this->getForm()->bind($line);                
                $cols_to_add = array();
                if ($this->getForm()->isValid())
                {                                                               
                    $meeting=$this->getForm()->getCustomerMeeting();                
                    if ($meeting->isNotLoaded())
                    {    
                        // throw new ImportException(ImportException::ERROR_IMPORT,__("Line %s: Meeting is already exists.",$this->current_line));    
                        if ($this->getUser()->getGuardUser()->hasCallcenter())
                            $meeting->set('callcenter_id',$this->getUser()->getGuardUser()->getCallcenter());  
                        if ($this->import_file->hasCampaign())
                            $meeting->set('campaign_id',$this->import_file->getCampaign()); 
                        if ($this->import_file->hasCallcenter())
                            $meeting->set('callcenter_id',$this->import_file->getCallcenter()); 
                        $meeting->set('creator_id',$this->getUser()->getGuardUser());
                        $meeting->save();         
                        // Foreign keys
                        $this->getForm()->setProducts($meeting);     
                        
                        // Send line to modules: meeting + getForm() through event                     
                        $this->object_inserted++;
                        $cols_to_add[] = "inserted";
                    }
                    else
                    {
                        if(isset($line['id']) && !empty($line['id']))
                        {
                            $meeting->save();
                            $this->object_updated++;
                            $this->getMessages()->addInfo(__("Line %s: Meeting is updated.",$this->current_line));
                            $cols_to_add[] = (__("Meeting is updated.",$this->current_line));
                        }
                        else{
                            $this->getMessages()->addInfo(__("Line %s: Meeting is already exists.",$this->current_line));
                            $cols_to_add[] = (__("Meeting is already exists.",$this->current_line));
                        }
                    }    
                    // propagate line to other module
                    mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getForm(), 'meeting.import.data',$meeting));
                    $this->log_file->writeLine($line, $cols_to_add);
                }   
                else 
                {                          
                    $errors=array();
                    foreach ($this->getForm()->getFields() as $name)
                    {                            
                            if ($this->form[$name]->hasError())
                                $errors[]=__("field-".$name).": ".$this->form[$name]->getError();                      
                    }                      
                    foreach ($this->getForm()->getErrorSchema()->getUnamedErrors() as $name=>$error)
                        $errors[]=$error;
                    $cols_to_add[] = "has error(s) : ".implode(",", $errors);
                    $this->log_file->writeLine($line, $cols_to_add);
                    throw new ImportException(ImportException::ERROR_IMPORT_FIELDS_ERROR,array('errors'=>$errors,'line'=>$this->current_line));                    
                } 
                $this->current_line++;      
            }
        }
        catch (ImportException $e)
        {
            throw new mfException($e->getI18nMessage());
        } 
        catch (mfException $e)
        {
            throw $e;
        } 
        
        if($this->import_file->getLinesProcessed()!=0)
            $this->current_line --;
        $this->import_file->addLine($this->current_line);
        $this->import_file->set("file_log",CustomerMeetingImportLogFile::getlogFileName());
        $this->import_file->save();
        $this->log_file->close();
        $this->close();
        
        CacheFile::removeAll();
    }
       
    function executeForDebug() 
    {                  
        try
        {            
            $this->log_file->open();
            if ($this->import_file->hasHeader())
            {    
                $this->import->readHeader();
                if($this->import_file->getLinesProcessed()==0)
                {
                    $this->log_file->writeHeader($this->import->getHeader(),array("import status","mode"));
                }
            }    
            //$this->verifyHeader();
            $this->initialize();  
            $this->import->seek($this->import_file->getLinesProcessed());           
            $max_lines=$this->getOption('max_lines',5); 
            
            while (($line=$this->getImport()->fetchArray()) &&  $max_lines--!=0)
            {
                $this->getForm()->setDefaults($line); 
                $this->getForm()->reconfigure();
                $this->getForm()->bind($line);
                
                $cols_to_add = array();
                if ($this->getForm()->isValid())
                {      
                    $meeting=$this->getForm()->getCustomerMeeting();
                    if ($meeting->isNotLoaded())
                    {    
                        if ($this->getUser()->getGuardUser()->hasCallcenter())
                            $meeting->set('callcenter_id',$this->getUser()->getGuardUser()->getCallcenter());  
                        if ($this->import_file->hasCampaign())
                            $meeting->set('campaign_id',$this->import_file->getCampaign()); 
                        if ($this->import_file->hasCallcenter())
                            $meeting->set('callcenter_id',$this->import_file->getCallcenter()); 
                        $this->object_inserted++;
                        $cols_to_add = array_merge(array("inserted","debug"),$cols_to_add);
                    }
                    else
                    {
                        if(isset($line['id']) && !empty($line['id']))
                        {
                            $this->object_updated++;
                            $this->getMessages()->addInfo(__("Line %s: Meeting is updated.",$this->current_line));
                            $cols_to_add[] = (__("Meeting is updated.",$this->current_line));
                        }
                        else{
                            $this->getMessages()->addInfo(__("Line %s: Meeting is already exists.",$this->current_line));
                            $cols_to_add = array_merge(array((__("Meeting is already exists.",$this->current_line)),"debug"),$cols_to_add);
                        }
                    }    
                    // propagate line to other module
                    $this->log_file->writeLine($line, $cols_to_add);
                }   
                else 
                {       
                    $errors=array();
                    $this->nb_errors++;
//                    echo $this->nb_errors."<br/>";
                    foreach ($this->getForm()->getFields() as $name)
                    {                       
                        if ($this->form[$name]->hasError())
                            $errors[$name]=__($name).": ".$this->form[$name]->getError();
                    }                      
                    $import_errors = new CustomerMeetingImportErrors();
                    $import_errors->setImport($this->import_file);
                    $import_errors->set("file", $this->log_file->getFilename());
                    
                    $cols_to_add = array_merge(array("has error","debug"),$cols_to_add);
                    
                    $import_errors->set("error_text", serialize($errors));
                    $import_errors->set("line", $this->current_line);
                    $import_errors->save();
                    $this->log_file->writeLine($line, $cols_to_add);
                } 
                $this->current_line++;      
            }
        }
        catch (ImportException $e)
        {
            throw new mfException($e->getI18nMessage());
        } 
        catch (mfException $e)
        {
            throw $e;
        } 
        
        if($this->import_file->getLinesProcessed()!=0)
            $this->current_line --;
        $this->import_file->addLine($this->current_line);
        $this->import_file->set("file_log",CustomerMeetingImportLogFile::getlogFileName());
        $this->import_file->save();
        $this->log_file->close();
        $this->close();
    }
    
    function getOption($option,$default=null)
    {
        return isset($this->options[$option])?$this->options[$option]:$default;
    }
    function getLogFileUrl()
    {
        return $this->import_file->getLogFile()->getUrl();
    }
    
    function getNumberOfErrors()
    {
        return $this->nb_errors;
    }
}


