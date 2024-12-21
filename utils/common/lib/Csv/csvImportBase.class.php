<?php


class csvImportBase {
    
    protected $options=array(),$header=null,$file=null,$handler=null,$site=null,$schema=null;
      
    function __construct($file,$options,$site=null)
    {               
        $this->file= $file;
        $this->options=array_merge(array('charset'=>'UTF-8','separator'=>";"),$options);  
        $this->site=$site;
        $this->configure();
    }                 
    
    protected function configure()
    {
        
    }
    
    function getFile()
    {
        return $this->file;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getHeader()
    {
        return $this->header;
    }
    
    function hasHeader()
    {
        return (boolean)$this->header;
    }
    
    function getSeparator()
    {
        return isset($this->options['separator'])?$this->options['separator']:null;
    }
    
    function debug()
    {
        $this->options['debug']=true;
    }
    
    function setOption($name,$value)
    {
      $this->options[$name]=$value;
            return $this;    
    }   
    
    function getOption($name,$default="")
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }        
    
    protected function escape($value="")
    {
       return str_replace('"', '""', $value); 
    }
    
    function getDataFromSchema($line)
    {
        $idx=0;
        $data=array();
        foreach ($this->schema as $field)
        {
            if ($field)            
                $data[$field]=$line[$idx];               
            $idx++;
        }  
        return $data;
    }
    
    function getDataFromHeader($line)
    { 
        $data=array();        
        foreach ($this->header as $index=>$name)
           $data[$name]=$line[$index];       
        return $data;
    }
    
    function fetchArray() 
    {                    
       $line=fgetcsv($this->handler, 0, $this->getOption('separator'));            
       if (!$line)
           return false;
       return $this->hasSchema()?$this->getDataFromSchema($line):$this->getDataFromHeader($line);       
    }

    protected function readHeader()
    {
        if ($this->header)
            return $this->header;
        if (($header = fgetcsv($this->handler, 0, $this->getOption('separator'))))
           $this->header=$header;       
    }
    
    function close()
    {
        if ($this->handler)
           fclose($this->handler); 
        return $this;
    }   
    
    function open()
    {
        if (!$this->handler)
        {               
            if (($this->handler=fopen($this->file,"r"))===FALSE)
                throw new ImportException(ImportException::ERROR_IMPORT_FILE_INVALID);            
        }
        return $this->handler;
    }                        
    
    function getFilePath()
    {
        return dirname($this->file);
    }
        
    function seek($num=0)
    {
        if ($num==0)
            return $this;              
        while (--$num !=0  && ($line = fgetcsv($this->handler, 0, $this->getOption('separator'))))
        {        
        }   
        return $this;
    }
    
    function getOptions()
    {
        return $this->options;
    }
    
   function setSchema($schema)
     {
         $this->schema=$schema;
         return $this;
     }
     
     function hasSchema()
     {
         return (boolean)$this->schema;
     }
}

