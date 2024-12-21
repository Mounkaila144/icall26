<?php


class SystemZip extends SystemCore
{

    protected $output=null,$files=null;
    
     function __construct($options=array(),$parameters=array()) {
        parent::__construct($options);        
        $this->files=new mfArray();     
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
    
    
    
    
    function getCommand()
    {
       /* $path=mfTools::isWindowsServer()?realpath(mfWebServer::getInstance()->getDocumentRoot().'/../../../../../../../').'"Program Files (x86)"':"";
        $version="";
        $dir=mfTools::isWindowsServer()?'"/PDFtk Server"/bin/':"";           
        $app=mfTools::isWindowsServer()?'pdftk.exe':'pdftk';   
        return $path.$version.$dir.$app;*/
    }
    
    function execute()
    {               
       /* $output=$this->hasOutput()?" output ".$this->getOutput()->getFile():"";
        $cmd=$this->getCommand()." ".(string)$this->getFiles()->implode(" ")." ".$this->getOptions()->implode(" ")." ".($this->hasXML()?$this->getXML()->getFile():"").$output." ".$this->getParameters()->implode(" ");   
      //  echo $cmd;
        $this->return=array();       
        $ret=exec($cmd,$this->return);              
        return $this;*/
    }
    
   
    
    function getVersion()
    {
        if ($this->version===null)
        {    
            $return=array();       
            $ret=exec($this->getCommand()." -version",$return);                             
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
    
    
}
