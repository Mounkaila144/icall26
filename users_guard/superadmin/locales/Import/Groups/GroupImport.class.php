<?php

require_once dirname(__FILE__)."/Forms/GroupImportForm.class.php";
require_once dirname(__FILE__)."/Forms/GroupImportFileForm.class.php";

class GroupImport extends ImportCore {
              
    function __construct($file, $type, $site = null) {
        parent::__construct($file, $type, $site);
        if ($type=='zip')
        {    
            $this->loader=new ImportZip('Groups',$site);
            $res=$this->getLoader()->open($file);       
            if ($res=$this->getLoader()->open($file)!==true)                
                throw new mfException(__("zip file [%s] can not be opened.",basename($file)));                  
            $this->getLoader()->extract();
            $this->getLoader()->close();      
            $file=$this->getLoader()->getPath()."/groups.csv";           
            $this->setPathForResources($this->getSourcePathForFiles());
        }           
        $this->import=new csvImport($file,array(),$site); 
    }               
            
    function execute() 
    {                  
        try
        {     
           $this->setForm(new GroupImportForm($this->getSourcePathForFiles(),$this->getSite()));  
           $this->verifyHeader();
           $this->initialize();          
           while ($line=$this->getImport()->fetchArray())
           {                                                      
                $this->getForm()->setDefaults($line);                
                $this->getForm()->bind($line);                  
                if ($this->getForm()->isValid())
                {      
                    $group=$this->getForm()->getGroup();
                    if ($group->isLoaded())
                        $this->object_updated++;
                    else
                        $this->object_inserted++; 
                    $group->save();                      
                    // Set external objects linked with objet               
                    if ($this->getForm()->getValue('permissions'))
                    {                        
                       if ($unknowns=PermissionUtils::setPermissionsForGroupImport($group,$this->getForm()->getValue('permissions')))                      
                            $this->getMessages()->addWarning(__("line %d : permissions [%s] don't exist.",array($this->current_line,implode(",",$unknowns))));
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


