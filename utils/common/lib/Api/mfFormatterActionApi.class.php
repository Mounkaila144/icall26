<?php

abstract class mfFormatterActionApi extends mfFormatterApi {
    
    
    abstract function getHeader();
    
     protected $data=array(),$user=null,$action=null;
     
     function __construct($action) {        
        $this->user = mfcontext::getInstance()->getUser();        
        $this->action=$action;  
        $this->widgets=new mfWidgetApiCollection();   
        $this->filter_widgets=new mfWidgetApiCollection();              
        parent::__construct(); 
    }
    
    function getUser()
    {
        return $this->user;
    }   
    function getAction()
    {        
        return $this->action;
    }   
        
    function getWidgets()
    {
        return $this->widgets;
    }
    
     function getFilterWidgets()
    {
        return $this->filter_widgets;
    }
    
    
    function getData() {
        if ($this->isFromTheme())                                          
            return $this->theme_api->getData(); 
        return $this->data;
    }
    
    protected function loadTheme()
    {
        if ($this->theme_api===null)
        {        
            $a = new ReflectionClass(get_called_class());  
            $filename=dirname($a->getFileName()).'/themes/'.$this->getTheme().'/Formatters/'.get_called_class().'.class.php';     
            if(file_exists($filename))
            {                
                require_once $filename;
                $class = $this->getThemeClass();
                if (!class_exists($class))
                    throw new InvalidArgumentException(__('Class is invalid'));                  
                $this->theme_api = new $class($this->getAction());  
            }           
        }
        return $this;
    }  
    
    
    
}
