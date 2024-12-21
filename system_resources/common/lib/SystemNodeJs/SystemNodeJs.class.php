<?php


class SystemNodeJs extends SystemCore
{

    protected $return=null,$errors=null;
    
    function __construct($options=array()) {
        parent::__construct(array_merge($options,array(
                   
            )));       
    }              
    
    function getCommand()
    {
       // $path=mfTools::isWindowsServer()?realpath($_SERVER['DOCUMENT_ROOT'].'/../../../../../../../').'"Program Files"\nodejs':"";       
        $path=mfTools::isWindowsServer()?realpath('C:/').'"Program Files"\nodejs':"";
        $app=mfTools::isWindowsServer()?'\node.exe':'nodejs';           
        return $path.$app;       
    }
    
    function execute()
    {                                 
        $cmd=$this->getCommand()." "; 
        //echo $cmd;
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
            $ret=exec($this->getCommand()." -v",$return); //$this->getCommand()." ",$return);              
            if (strpos($return[0],'v')===false)
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
