<?php



abstract class ImportCore extends SiteObject {
    
    protected $form=array(),$loader=null,$import=null, $object_inserted=0,$path=null,
              $object_updated=0,$messages=null,$current_line=0,$pathForResources=null;
    
    abstract function execute();   
    
    function __construct($file=null, $type=null, $site = null) 
    {
         $this->site=$site;
         $this->messages=new mfMessagesComponent();
         $this->configure();
    }
    
    protected function configure()
    {
        
    }
    
    
    function setPathForResources($path)
    {
        $this->pathForResources=$path;
        return $this;
    }
    
    function getPathForResources()
    {
       return $this->pathForResources;
    }
    
    function setForm($form)
    {
      $this->form=$form;
      return $this;
    }
    
    function getForm()
    {
       return $this->form;
    }         
    
    function getImport()
    {
       return $this->import; 
    }   
    
    protected function getLoader()
    {
       return $this->loader; 
    } 
    
    protected function hasLoader()
    {
        return (boolean)$this->loader;
    }            


    protected function getSourcePathForFiles()
    {
       if ($this->hasLoader())
           return $this->getLoader()->getPath();
       return $this->path;
    }  
    
    function setSourcePathForFiles($path)
    {
        $this->path=$path;
        return $this;
    }
    
    function open()
    {        
        $this->getImport()->open();
        return $this;
    }
    
    function close()
    {        
        $this->getImport()->close();    
        if ($this->hasLoader())
            $this->getLoader()->remove();   
    }
    
     function setObjectInserted($value)
    {
       $this->object_inserted=$value;
       return $this;
    }
    
    function setObjectUpdated($value)
    {
       $this->object_updated=$value;
       return $this;
    }
    
    function getObjectInserted()
    {
       return $this->object_inserted;       
    }
    
    function getObjectUpdated()
    {
       return $this->object_updated;
    }
    
    protected function checkRequiredFieldInHeader()
    {                
       foreach ($this->getForm()->getValidatorSchema()->getSchema() as $fieldName=>$validator)
       {        
           if ($validator->getOption('required'))
           {
               if (!in_array($fieldName,(array)$this->getImport()->getHeader())) 
                   throw new ImportException(ImportException::ERROR_IMPORT_FIELD_NAME_MANDATORY_MISSING,array('name'=>$fieldName));
           }             
       }    
    }   
    
    protected function checkHeader()
    {
         if (!$this->getImport()->getHeader())
            return ;        
         foreach ($this->getImport()->getHeader() as $field)
         {                   
             if (!$this->getForm()->hasValidator($field))
                throw new ImportException(ImportException::ERROR_IMPORT_FIELD_NAME_INVALID,array('name'=>$field));                           
         }    
    }         
    
    protected function checkDoubleFieldInHeader()
    {
        $errors=array();
        foreach (array_count_values($this->getImport()->getHeader()) as $name=>$count)
        {
            if ($count>1)
                $errors[]=$name;
        }
        if ($errors)
           throw new ImportException(ImportException::ERROR_IMPORT_FIELD_NAME_IDENTICAL,array('fields'=>implode(",",$errors)));            
    }    
    
    function verifyHeader()
    {       
      $this->checkHeader();
      $this->checkDoubleFieldInHeader();
      $this->checkRequiredFieldInHeader();     
    }
    
     function initialize()
     {
          $this->current_line=1;
          $this->setObjectInserted(0);
          $this->setObjectUpdated(0);     
     }
     
     function getMessages()
     {
         return $this->messages;
     }
}


