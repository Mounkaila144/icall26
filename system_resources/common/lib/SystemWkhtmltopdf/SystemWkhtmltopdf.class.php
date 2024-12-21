<?php


class SystemWkhtmltopdf extends SystemCore
{
 
            
    function getCommand()
    {
       // $path=mfTools::isWindowsServer()?realpath($_SERVER['DOCUMENT_ROOT'].'/../../../../../../../').'"Program Files"\wkhtmltopdf':"";   
        $path=mfTools::isWindowsServer()?realpath("C:\\").'"Program Files"\\wkhtmltopdf':"";
        $dir=mfTools::isWindowsServer()?"\\bin\\":"";           
        $app=mfTools::isWindowsServer()?'wkhtmltopdf.exe':'wkhtmltopdf';                          
        return $path.$dir.$app;
    }
    
    function execute()
    {                   
        mfFileSystem::mkdirs(dirname($this->getOption('output')));             
        $cmd=$this->getCommand()." ".$this->getOption('options')." ".$this->getOption('input')." ".$this->getOption('output')." ".$this->getOption('log');  
         if ($this->getVersionNumber()=='0.12.2.4')
            $cmd="xvfb-run ".$cmd;    
        $return=array();       
        $ret=exec($cmd,$return);           
        return $this;
    }
       
    
    function getVersionNumber()
    {
        return str_replace(array('wkhtmltopdf',' ','(withpatchedqt)'),"",$this->getVersion());
    }
    
    function getVersion()
    {
        if ($this->version===null)
        {    
            $return=array();       
            $ret=exec($this->getCommand()." -V",$return);                        
            if (strpos($return[0],'wkhtmltopdf')===false)
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
