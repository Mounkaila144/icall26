<?php


class SystemPdfToText extends SystemCore
{

    protected $output=null,$file=null;
    
    function __construct(File $file=null,File $output=null,$options=array()) {
       $this->file=$file;
        $this->root=$root;
        if ($output===null && $file!=null)      
            $this->output=new File($file->getDirectory()."/output.txt");
        else
        {                
            $this->output=$output;
        }    
        if ($this->output)
        {
            mfFileSystem::mkdirs($this->output->getDirectory()); 
        }
        parent::__construct(array_merge($options,array(                  
            )));      
       $this->errors=new mfArray();
    }        
    
   /* function setOutput($output)
    {
        $this->output=$output;
        $this->setOption('sOutputFile',$this->output);
        return $this;
    }              
        
    
    function getOutput()
    {
        return $this->output;
    }
    
  /*  function getOutputFile()
    {
        return new File($this->getOutput());
    }*/
    
    function getCommand()
    {
       $path=mfTools::isWindowsServer()?realpath($_SERVER['DOCUMENT_ROOT'].'/../../../../../../../').'\"Program Files (x86)"':"";     
       $dir=mfTools::isWindowsServer()?"\poppler-":"";
       $version=mfTools::isWindowsServer()?"0.51":"";  
       $bin=mfTools::isWindowsServer()?"\bin\\":"";         
       $app="pdftotext".(mfTools::isWindowsServer()?'.exe':"");             
       return $path.$dir.$version.$bin.$app;
    }
    
    function execute()
    {            
        $cmd=escapeshellcmd($this->getCommand())." ".$this->getOptions()." ".str_replace(" ","\\ ",$this->file->getFile())." ".$this->output->getFile();                
        $this->return=array();            
        $ret=exec($cmd,$this->return);       
    }       
        
    function getReturn()
    {
        return new mfArray($this->return);
    }
    
    function getVersion()
    {
        if ($this->version===null)
        {    
            $return=array();                  
            $ret=exec($this->getCommand()." -v",$return,$result);                         
            if ($result!=0)
            {               
                $this->errors[]='version not found';
                $this->version=false;
                return $this->version;
            }
            $this->version="Version unknown";          
        }
        return $this->version;
    }
    
    function hasErrors()
    {
        return !$this->getErrors()->isEmpty();
    }
    
    function getErrors()
    {
        return $this->errors;
    }
}
