<?php

class SystemTar extends SystemShell {
    
    protected static $instance=null;     
    
    function tar($options="")
    {       
         return $this->execute('tar '.$options); 
    }        
    
}
