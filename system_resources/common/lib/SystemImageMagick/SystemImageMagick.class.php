<?php


class SystemImageMagick extends SystemCore
{
   
    function getErrorCode(){
        return $this->error_code;
    }
    
    function hasError(){
        return $this->has_error;
    }
    
    
    function getVersion()
    {
        if ($this->version===null)
        {    
           $return=array();                   
            $ret=exec($this->getCommand((mfTools::isWindowsServer()?"":"convert"))." -version",$return);                           
            if (strpos($return[0],'ImageMagick')===false)
            {               
                $this->errors[]='version not found';
                $this->version=false;
                return $this->version;
            }
            $this->version=$return[0];         
        }      
        return $this->version;
    }
    
     
    
        
    function getCommand($command="")
    {
       // $path=mfTools::isWindowsServer()?realpath(mfWebServer::getInstance()->getDocumentRoot().'/../../../../../../../').'"Program Files"':"";  
        $path=mfTools::isWindowsServer()?realpath('C:/').'"Program Files"':"";
      //  $dir=mfTools::isWindowsServer()?'"/ImageMagick-7.0.8-Q16"/':""; 
        $dir=mfTools::isWindowsServer()?'"/ImageMagick-7.0.10-Q16-HDRI"/':""; 
        $app=mfTools::isWindowsServer()?'magick.exe':"";   
        return $path.$dir.$app." ".$command;
    }

    function getResult($name,$default=null)
    {        
        return isset($this->results[$name])?$this->results[$name]:$default;
    }
    
    function getErrors()
    {
        return $this->errors;
    }
        
     function setOptions($options)
    {
        $this->options=new mfArray($options);
        return $this;
    }
    
     
    
     function execute()
    {                       
        $cmd=$this->getCommand()." ".$this->options->implode(" ");
      //  echo $cmd;
        $this->return=array();       
        $ret=exec($cmd,$this->return);              
        return $this;
    }
    
    function convert()
    {
        $cmd=$this->getCommand().(mfTools::isWindowsServer()?"":" convert ").$this->options->implode(" ");
        if ($this->isDebug())
            echo $cmd."<br/>";
        $this->return=array();       
        $ret=exec($cmd,$this->return);              
        return $this;
    }
   
}
