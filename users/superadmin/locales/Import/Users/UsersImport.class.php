<?php

require_once dirname(__FILE__)."/Forms/UsersImportForm.class.php";
require_once dirname(__FILE__)."/Forms/UserImportFileForm.class.php";

class UsersImport extends ImportCore {
              
    function __construct($file, $type, $site = null) {
        parent::__construct($file, $type, $site);
        if ($type=='zip')
        {    
            $this->loader=new ImportZip('Users',$site);
            $res=$this->getLoader()->open($file);       
            if ($res=$this->getLoader()->open($file)!==true)                
                throw new mfException(__("zip file [%s] can not be opened.",basename($file)));                  
            $this->getLoader()->extract();
            $this->getLoader()->close();      
            $file=$this->getLoader()->getPath()."/users.csv";           
            $this->setPathForResources($this->getSourcePathForFiles());
        }           
        $this->import=new csvImport($file,array(),$site); 
    }               
            
    function execute() 
    {                  
        try
        {     
           $this->setForm(new UsersImportForm($this->getSourcePathForFiles(),$this->getSite()));  
           $this->verifyHeader();
           $this->initialize();          
           while ($line=$this->getImport()->fetchArray())
           {                                                      
                $this->getForm()->setDefaults($line);                
                $this->getForm()->bind($line);                  
                if ($this->getForm()->isValid())
                {      
                    $user=$this->getForm()->getUser();
                    if ($user->isLoaded())
                        $this->object_updated++;
                    else
                        $this->object_inserted++; 
                    $user->save();               
                    
                    if ($this->getForm()->getValue('functions'))
                    {                        
                       if ($unknowns=UserFunctionUtils::setFunctionsForUserImport($user,$this->getForm()->getValue('functions')))                      
                            $this->getMessages()->addWarning(__("line %d : functions [%s] don't exist.",array($this->current_line,implode(",",$unknowns))));
                    }
                    if ($this->getForm()->getValue('groups'))
                    {                        
                       if ($unknowns=GroupUtils::setGroupsForUserImport($user,$this->getForm()->getValue('groups')))                      
                            $this->getMessages()->addWarning(__("line %d : groups [%s] don't exist.",array($this->current_line,implode(",",$unknowns))));
                    }
                    if ($this->getForm()->getValue('teams'))
                    {                        
                       if ($unknowns=UserTeamUtils::setTeamsForUserImport($user,$this->getForm()->getValue('teams')))                      
                            $this->getMessages()->addWarning(__("line %d : teams [%s] don't exist.",array($this->current_line,implode(",",$unknowns))));
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


