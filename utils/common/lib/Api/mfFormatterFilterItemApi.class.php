<?php

abstract class mfFormatterFilterItemApi extends mfFormatterItemApi {
     
     protected $filter=null;
    
    function __construct($item,$filter=null) {      
         $this->item=$item;   
         $this->filter=$filter;
         parent::__construct();             
    }
    
    function getItem()
    {
        return $this->item;
    }
    
    
    function getFilter()
    {
       return $this->filter; 
    }
    
    
     protected function loadTheme()
    {
        if ($this->theme_api===null)
        {   
            
         //  echo "Class=".get_called_class()."<br/>";
           
            if (stripos(get_called_class(),$this->getTheme().$this->getTheme())!==false)
                   return $this->theme_api=$this->theme_api=false;    
             
            $a = new ReflectionClass(get_called_class());               
            $filename=dirname($a->getFileName()).'/'.$this->getTheme()."/".get_called_class().'.class.php';                   
            if(file_exists($filename))
            {                              
                 require_once $filename;
                $class = $this->getThemeClass();                        
               // echo "Class".$class."<br/>";
                if (!class_exists($class))
                     return $this->theme_api=$this->theme_api=false;        
                $this->theme_api = new $class($this->getItem(),$this->getFilter());             
            }
        }
        return $this;
    }  
    
    
    protected function isFromThemeFormatter()
    {
        return (boolean)$this->theme_formatter_api;
    }
    
    protected function loadFormatterTheme()
    {
        if ($this->theme_formatter_api===null)
        {                  
            $a = new ReflectionClass(get_called_class());               
            $filename=dirname(str_replace('\Formatters', '', $a->getFileName())).'/themes/'.$this->getTheme()."/Formatters/".get_called_class().'.class.php'; 
            if(file_exists($filename))
            {                       
                  require_once $filename;
                  $class = $this->getThemeClass();
                  if (!class_exists($class))
                      throw new InvalidArgumentException(__('Class is invalid'));                  
                  $this->theme_formatter_api = new $class($this->getItem(),$this->getFilter());  
            }
        }
        return $this;
    }
}
    
    
