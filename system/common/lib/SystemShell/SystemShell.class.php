<?php


class SystemShell extends  SystemCore
{
    protected static $instance=null;
       
    
    function execute($cmd="",$options="")
    {                      
        $cmd.=" ".$options;   
        if ($this->isDebug())
           echo $cmd."<br/>";
        $return=array();            
        $ret=exec($cmd,$return); 
        $this->return=new SystemReturn($return);      
        return $this->return;
    }
    
    function getVersion()
    {
        return "?";
    }
       
    function ls($options="")
    {
        return $this->execute('ls',$options);
    }
    
    function dir($options="")
    {
        return $this->execute('dir',$options);
    }
    
    function du($options="")
    {
       return $this->execute('du',$options); 
    }
    
    function kill($options="")
    {        
        return $this->execute('kill '.$options); 
    }
    
    function ps($options="")
    {
        return $this->execute('ps '.$options); 
    }
    
    function wget($options="")
    {
        return $this->execute('wget '.$options); 
    }
    
    function mv($options="")
    {
        return $this->execute('mv '.$options); 
    }
    
    function chown($options="")
    {
        return $this->execute('chown '.$options); 
    }
    
     function chmod($options="")
    {
        return $this->execute('chmod '.$options); 
    }
     function df($options="")
    {
        return $this->execute('df '.$options); 
    }
    
}
