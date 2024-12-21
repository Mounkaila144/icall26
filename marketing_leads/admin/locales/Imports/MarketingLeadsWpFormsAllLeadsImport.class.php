<?php

require_once dirname(__FILE__)."/Forms/MarketingLeadsWpFormsAllLeadsImportForm.class.php";

class MarketingLeadsWpFormsAllLeadsImport extends ImportCore {
              
    protected $options=array(),$import_file=null,$user=null,$log_file=null,$nb_errors=0,$site_campaign=null;
    
    function __construct($user,$import_file, $type='csv',$options=array()) {
        $this->user=$user;
        parent::__construct();
        $this->import_file=$import_file;
        $this->site_campaign=$import_file->getCampaign();
        $this->options=array_merge($options,array('max_lines'=>50));
        $this->import=new CsvImport($import_file->getFile()->getFile(),array()); 
        $this->import->setSchema($import_file->getSchema());      
        $this->import->open();
        $this->setForm(new MarketingLeadsWpFormsAllLeadsImportForm($this->getUser()));
        $file = $this->import_file->getFileDirectory()."/". MarketingLeadsWpFormsAllLeadsImportLogFile::getlogFileName();
        $this->log_file = new MarketingLeadsWpFormsAllLeadsImportLogFile($file,"a+");
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
                    $lead=$this->getForm()->getWpFormLead();
                    if ($lead->isNotLoaded())
                    {    
                        $lead->set('site_id',$this->site_campaign);
                        $lead->save();                            
                        $this->object_inserted++;
                        $cols_to_add[] = "inserted";
                    }
                    else
                    {
                        $this->getMessages()->addInfo(__("Line %s: Lead is already exists.",$this->current_line));
                        $cols_to_add[] = (__("Lead is already exists.",$this->current_line));
                    }    
                    // propagate line to other module
                    mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getForm(), 'wp.forms.lead.import.data',$lead));
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
                    $cols_to_add[] = "has error(s) : ".implode(",", $errors);
                    $this->log_file->writeLine($line, $cols_to_add);
                    throw new ImportException(ImportException::ERROR_IMPORT_FIELDS_ERROR,array('errors'=>$errors,'line'=>$this->import_file->getLinesProcessed()+$this->current_line));                    
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
        $this->import_file->set("file_log",MarketingLeadsWpFormsAllLeadsImportLogFile::getlogFileName());
        $this->import_file->save();
        $this->log_file->close();
        $this->close();
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
                    $lead=$this->getForm()->getWpFormLead();
                    if ($lead->isNotLoaded())
                    { 
                        // Send line to modules: contract + getForm() through event                     
                        $this->object_inserted++;
                        $cols_to_add = array_merge(array("inserted","debug"),$cols_to_add);
                    }
                    else
                    {
                        $this->getMessages()->addInfo(__("Line %s: Lead is already exists.",$this->current_line));
                        $cols_to_add = array_merge(array((__("Lead is already exists.",$this->current_line)),"debug"),$cols_to_add);
                    }    
                    // propagate line to other module
                    $this->log_file->writeLine($line, $cols_to_add);
                }   
                else 
                {       
                    $errors=array();
                    $this->nb_errors++;
                    foreach ($this->getForm()->getFields() as $name)
                    {                       
                        if ($this->form[$name]->hasError())
                            $errors[$name]=__($name).": ".$this->form[$name]->getError();
                    }                      
                    $import_errors = new MarketingLeadsWpFormsLeadsImportErrors();//to add
                    $import_errors->setImport($this->import_file);
                    $import_errors->set("file", $this->log_file->getFilename());
                    
                    $cols_to_add = array_merge(array("has error","debug"),$cols_to_add);
                    
                    $import_errors->set("error_text", serialize($errors));
                    $import_errors->set("line", $this->import_file->getLinesProcessed()+$this->current_line-1);
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
        $this->import_file->set("file_log",MarketingLeadsWpFormsAllLeadsImportLogFile::getlogFileName());
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


