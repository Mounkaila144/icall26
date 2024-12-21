<?php


class SystemLibreOffice extends SystemCore
{

    protected $output=null,$file=null,$parameters=null,$xml=null,$return=null;
    
     function __construct($options=array(),$parameters=array()) {
        parent::__construct($options);        
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

    function setOutput(File $output)
    {
        mfFileSystem::mkdirs($output->getDirectory());
        $this->output=$output;
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
    
     function setFile(File $file)
    {
        $this->file=$file;
        return $this;
    }
       
        
    function getFile()
    {
        return $this->file;
    }
    
    
    function getCommand()
    {        
        //$path=mfTools::isWindowsServer()?realpath(mfWebServer::getInstance()->getDocumentRoot().'/../../../../../../../').'"Program Files (x86)"':"";
        $path=mfTools::isWindowsServer()?realpath('C:/').'"Program Files"':"";
        $version="";
        $dir=mfTools::isWindowsServer()?'"\\LibreOffice\\program\\':"";       
        if (mfTools::isWindowsServer())
            $app='soffice.exe';
        elseif (mfTools::isDebian())
            $app='export HOME=/data/www/html/tmp && libreoffice';   
        else
            $app='libreoffice';  
        return $path.$version.$dir.$app;
    }
    
    function execute()
    {               
        $output=$this->hasOutput()?" --outdir ".$this->getOutput()->getDirectory():"";
        $cmd=$this->getCommand()." ".$this->getOptions()->implode(" ")." ".(string)$this->getFile()->getFile()." ".$output;      
        $this->return=array();     
        if ($this->isDebug())
          echo "CMD=".$cmd."<br/>";
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
           // var_dump($this->getCommand(),$return,$ret);            
            if (stripos($return[0],'LibreOffice')===false)
            {               
                $this->errors[]='version not found';
                $this->version=false;
                return $this->version;
            }
            $this->version=$return[0];         
        }
        return $this->version;
    }
    
   
}
