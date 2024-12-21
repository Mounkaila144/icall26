<?php

// gs -SDEVICE=pdfwrite -sOutputFile=out.pdf  out.ps

class SystemGhostScript extends SystemCore
{

    protected $output=null,$files=null;
    
    function __construct($options=array()) {
        parent::__construct(array_merge($options,array(
            'sDEVICE'=>'pdfwrite',
            'dBATCH'=>null,
         //   'dSAFER'=>null,
            'dNOPAUSE '=>null,
            'q'=>null,
            'sOutputFile'=>'out.pdf'            
            )));
        $this->files=new mfArray();
        $this->errors=new mfArray();
    }        
    
    function setOutput($output)
    {
        $this->output=$output;
        $this->setOption('sOutputFile',$this->output);
        return $this;
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
    
    function getOutput()
    {
        return $this->output;
    }
    
    function getOutputFile()
    {
        return new File($this->getOutput());
    }
    
    function getCommand()
    {
       // $path=mfTools::isWindowsServer()?realpath($_SERVER['DOCUMENT_ROOT'].'/../../../../../../../').'"Program Files"\gs':"";
        $path=mfTools::isWindowsServer()?realpath('C:/').'"Program Files"\gs':"";
        $version=mfTools::isWindowsServer()?"\gs9.21":"";
        $dir=mfTools::isWindowsServer()?"\bin\\":"";           
        $app=mfTools::isWindowsServer()?'gswin64c':'gs';   
        return $path.$version.$dir.$app;
    }
    
    function execute()
    {            
        $options="";
        foreach ($this->getOptions() as $name=>$option)       
            $options.=" -".$name.($option?"=".$option:" ")." ";                 
        $cmd=$this->getCommand()." ".$options." ".(string)$this->getFiles()->implode(" ");   
        if ($this->isDebug())
            echo $cmd;
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
            $ret=exec($this->getCommand()." -v",$return);              
            if (strpos($return[0],'Ghostscript')===false)
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
