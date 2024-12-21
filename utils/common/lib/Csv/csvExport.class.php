<?php


abstract class csvExport extends mfDatabaseExport {
    
    protected $options=array(),$debug=false,$header=null,$filename=null,$separator=";";
    
    abstract protected function getFilename();
      
    function __construct($options,$class,$application=null,$site=null)
    {       
        if (!class_exists($class))
           throw new mfException("csv export class doesn't exist.");
        $this->options=array_merge(array('charset_db'=>'UTF-8','charset'=>'ISO-8859-1','cache'=>true),$options);      
        parent::__construct($class, $application, $site); 
    }   
    
    function setFilename($filename)
    {
        $this->filename=$filename;        
        return $this;
    }
    
    function setFile($filename)
    {
        $this->filename=$filename;        
        return $this;
    }
    
    function setHeader($header)
    {
        $this->header=$header;
        return $this;
    }
    
    function getHeader()
    {
        return $this->header;
    }
    
     function setSeparator($separator)
    {
        $this->separator=$separator;
        return $this;
    }
    
    function debug()
    {
        $this->debug=true;
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
    
    protected function conv($value)
    {
       // var_dump($this->options['charset'], $this->options['charset_db']);die(__METHOD__);
      return mb_convert_encoding($value,$this->options['charset'], $this->options['charset_db']);
    }
    
    protected function formatField($name)
    {
        return '"'.$this->conv($this->escape($name)).'"'.$this->separator;
    }
    
    protected function outputHeader()
    {
       $header="";        
       if ($this->getHeader()===null)
       {
            foreach ($this->getFields() as $field=>$name)
            {          
                if (is_numeric($field))
                   $header.=$this->formatField($name);
                else
                   $header.=$this->formatField($field); 
            }    
       } 
       elseif ($this->getHeader())
       {
            $max=count($this->getFields());
            foreach ($this->getHeader() as $name)
            {   
                if ($max--==0)
                    break;
                $header.=$this->formatField($name);
            }             
       }    
      
       if ($header)
       {    
           $header = substr($header, 0, -1)."\n"; // On enleve la derniere virgule
           $this->writeLine($header);
       }
    }
    
    protected function getObjectFields($objects)
    {
       $data=array();
       foreach ($this->getFields() as $name=>$field)
       {     
            if (is_numeric($name))
            {
               $object=$this->getObject();
            }   
            else
            {
               $object=$field; 
               $field=$name;
            }                        
            $data[$field]=$objects[$object]->get($field);
      }    
      return $data;
    }   
    
    protected function outputLine($row)
    {            
        $data="";
        if ($this->hasObjects())
        {                           
            foreach ($this->getObjectFields($row) as $value)
               $data.=$this->formatField($value);
        }
        else
        {    
            // Case unique object         
            foreach ($this->getFields() as $field)
            {
               $data.=$this->formatField($row->get($field));
            } 
        }
        if ($data)
        {    
            $data = substr($data, 0, -1)."\n"; // On enleve la derniere virgule
            $this->writeLine($data);
        }    
    }
    
    function output($filename="")
    {              
        if ($this->isDebug())       
            return $this->execute();        
        if ($this->getOption('cache',false)==false)    
        {
            $this->execute(); 
            $this->httpHeader();
            readfile($this->filename);
            return $this;
        }        
                
        if ($this->filename) {
            if (!is_readable($this->filename)) 
            {                
                $this->execute();
            }
            $this->httpHeader();
            readfile($this->filename);
        }
        else
        {
            $this->setFilename($filename);     
            if (!is_readable($this->filename)) 
            {                
                $this->execute();
            }
            $this->httpHeader();
            readfile($this->filename);
        }    
    }
    
    function httpHeader()
    {
      header("Content-type: application/vnd.ms-excel");
      header("Content-disposition: csv".date("Y-m-d").".csv");
      header("Content-disposition: filename=".basename($this->filename,'.csv').".csv");  
    }
    
    function writeLine($data) {        
        if ($this->isDebug())            // Output in standard output
            echo $data."<br/>";
        elseif ($this->file)             // Output in file
          $this->file->write($data);
     //  else
      //    $this->data.=$data;            // Output in data
    }
    
     protected function _getHeader()
    {        
       if (is_array($this->header))
       {        
           return $this->header;
       }      
       elseif ($this->header===null) 
       {
           return $this->getDefaultFields();
       }    
       return array();
    }
    
    protected function close()
    {
        $this->file->close();
    }     
    
    protected function open()
    {
        if (!$this->filename)
            return ;
        $this->file=new File($this->filename,"w+");
        if (!$this->file->open())
          throw new mfException(sprintf("Export file open error. (%s)",basename($this->filename)));  
    }
    
    protected function isDebug()
    {
        return $this->debug;
    }        
    
    protected function execute()
    {        
        if (!$this->isDebug())
            $this->open();
        $this->outputHeader();
        parent::execute();
        if (!$this->isDebug())
        $this->close();
    }        
}

