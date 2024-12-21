<?php


class SystemPdfJam extends SystemCore
{
   
   
     function getVersion()
    {
        if ($this->version===null)
        {
            $return=array();
            $ret=exec($this->getCommand(" --help"),$return);
            if (strpos($return[1],'pdfjam')===false)
            {
                $this->errors[]='version not found';
                $this->version=false;
                return $this->version;
            }
            $return =array();
            $ret=exec($this->getCommand(" --version"),$return);
            $this->version=$return[0];
        }
        return $this->version;
    }

    
     
    
        
    function getCommand($command="")
    {
       // $path=mfTools::isWindowsServer()?realpath(mfWebServer::getInstance()->getDocumentRoot().'/../../../../../../../').'"Program Files"':"";  
        $path=mfTools::isWindowsServer()?realpath('C:/').'"Program Files"':"";
      //  $dir=mfTools::isWindowsServer()?'"/ImageMagick-7.0.8-Q16"/':""; 
        $dir=mfTools::isWindowsServer()?'"/xxxxx"/':""; 
        $app=mfTools::isWindowsServer()?'xxxxx':"pdfjam";   
        return $path.$dir.$app." ".$command;
    }

    function getResult($name,$default=null)
    {        
        return isset($this->results[$name])?$this->results[$name]:$default;
    }
    
   
    
     function execute()
    {                       
        $cmd=$this->getCommand()." ".$this->options->implode(" ");
        if ($this->isDebug())
            echo $cmd."<br/>";
        $this->return=array();       
        $ret=exec($cmd,$this->return);              
        return $this;
    }
    
     
   
}
