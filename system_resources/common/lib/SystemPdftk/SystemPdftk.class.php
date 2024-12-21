<?php


class SystemPdftk extends SystemCore
{

    protected $output=null,$files=null,$parameters=null,$xml=null,$return=null,$options=null;
    
     function __construct($options=array(),$parameters=array()) {
        parent::__construct($options);        
        $this->files=new mfArray();
        $this->parameters=new mfArray($parameters);
    }         

function setParameters($parameters)    
{
    $this->parameters=$parameters;
    return $this;
}

function getParameters()    
{
    return $this->parameters;
}

function setParameter($name,$value)
{
    $this->parameters[$name]=$value;
    return $this;
}

function getParameter($name,$default=null)
{
    return isset($this->parameters[$name])?$this->parameters[$name]:$default;
}        

    function setOutput($output)
    {
        $this->output=new File($output);
        return $this;
    }
    
    function hasOutput()
    {
        return (boolean)$this->output;
    }
    
    function getOutput()
    {
        return $this->output;
    }
    
     function setFiles(mfArray $files)
    {
        $this->files=$files;
        return $this;
    }
    
    function addFile($file)
    {
        $this->files[]=$file;
        return $this;
    }
        
    function getFiles()
    {
        return $this->files;
    }
    
    function hasXML()
    {
        return (boolean)$this->xml;
    }
    
    function getXML()
    {
       return $this->xml; 
    }   
                
    protected function getXmlFileFromOutput()
    {
        return $this->getOutput()->getDirectory()."/".$this->getOutput()->getFilename().".xml";
    }
   
    function setDataForForm($data)
    {
        $this->xml=new SystemPdftkXmlFile($this->getXmlFileFromOutput());
        $this->xml->setFields($data);   
        $this->xml->save();
        return $this;
    }
    
    function setXMlDataFileForForm($xml)
    {
        $this->xml=new File($xml);        
        return $this;
    }
        
    function getCommand()
    {        
        //$path=mfTools::isWindowsServer()?realpath(mfWebServer::getInstance()->getDocumentRoot().'/../../../../../../../').'"Program Files (x86)"':"";
        $path=mfTools::isWindowsServer()?realpath('C:/').'"Program Files (x86)"':"";
        $version="";
        $dir=mfTools::isWindowsServer()?'"/PDFtk Server"/bin/':"";           
        $app=mfTools::isWindowsServer()?'pdftk.exe':'pdftk';   
        return $path.$version.$dir.$app;
    }
    
    function execute()
    {               
        $output=$this->hasOutput()?" output ".$this->getOutput()->getFile():"";
        $cmd=$this->getCommand()." ".(string)$this->getFiles()->implode(" ")." ".$this->getOptions()->implode(" ")." ".($this->hasXML()?$this->getXML()->getFile():"").(string)$output." ".$this->getParameters()->implode(" ");        
        if ($this->isDebug())
            echo "Cmd=".$cmd."<br/>";        
        $this->return=array();       
        $ret=exec($cmd,$this->return);              
        return $this;
    }
    
    function getReturn()
    {
        return $this->return;
    }
    
    function getVersion()
    {
        if ($this->version===null)
        {    
            $return=array();       
            $ret=exec($this->getCommand()." --version",$return);                             
            if (strpos($return[1],'pdftk')===false)
            {               
                $this->errors[]='version not found';
                $this->version=false;
                return $this->version;
            }
            $this->version=$return[1];         
        }
        return $this->version;
    }
    
    function getFieldNames()
    {
        $fields=new mfArray();
        foreach ($this->getReturn() as $line)
        {          
            if (strpos($line,'FieldName')!==false)   
                 $fields[]=trim(str_replace("FieldName: ","",$line));
        }    
        return $fields;
    }
    
    function getNumberOfPages()
    {            
        foreach ($this->getReturn() as $line)
        {                   
            if (strpos($line,'NumberOfPages')!==false)   
            {              
                $tmp=explode(":",$line);               
                return intval(trim($tmp[1]));
            }
        }    
        return 0;
    }
}
