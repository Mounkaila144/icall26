<?php

require_once dirname(__FILE__)."/Forms/UserTeamsImportForm.class.php";
require_once dirname(__FILE__)."/Forms/UserTeamImportFileForm.class.php";

class UserTeamsImport extends ImportCore {
              
    function __construct($file, $type, $site = null) {
        parent::__construct($file, $type, $site);
        if ($type=='zip')
        {    
            $this->loader=new ImportZip('Teams',$site);
            $res=$this->getLoader()->open($file);       
            if ($res=$this->getLoader()->open($file)!==true)                
                throw new mfException(__("zip file [%s] can not be opened.",basename($file)));                  
            $this->getLoader()->extract();
            $this->getLoader()->close();      
            $file=$this->getLoader()->getPath()."/teams.csv";           
            $this->setPathForResources($this->getSourcePathForFiles());
        }           
        $this->import=new csvImport($file,array(),$site); 
    }               
            
    function execute() 
    {                  
        try
        {     
           $this->setForm(new UserTeamsImportForm($this->getSourcePathForFiles(),$this->getSite()));  
           $this->verifyHeader();
           $this->initialize();          
           while ($line=$this->getImport()->fetchArray())
           {                                                      
                $this->getForm()->setDefaults($line);                
                $this->getForm()->bind($line);                  
                if ($this->getForm()->isValid())
                {      
                    $team=$this->getForm()->getTeam();
                    if ($team->isLoaded())
                        $this->object_updated++;
                    else
                        $this->object_inserted++; 
                    $team->save();
                    
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


