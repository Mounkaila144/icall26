<?php

abstract class mfFormatterApi {
    
    static protected $site=null;
    
    protected $data=array(),$client=null,$theme_api=null,$directory="";
       
    abstract function getData();    
    
    function __construct() {         
        $this->user = mfcontext::getInstance()->getUser();
        if (self::$site===null)
            self::$site=mfcontext::getInstance()->getRequest()->getSite();
        $this->widgets= new mfWidgetApiCollection();
        $this->configure();
        $this->process();
    }
    
    function configure()
    {
        return $this;        
    }
    
    protected function getItem()
    {
        
    }
    
    protected function isFromTheme()
    {
        return (boolean)$this->theme_api;
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
                  $this->theme_api = new $class($this->getItem(),$this->getForm());  
            }
        }
        return $this;
    }  
    
    function getTheme()
    {
        return self::$site->getTheme();
    }
    
     protected function getThemeClass()
    {
        return str_replace("FormatterApi",ucfirst($this->getTheme())."FormatterApi",get_called_class());
    }
    
    
    function getUser()
    {
        return $this->user;
    }
        
    function getWidgets()
    {
        return $this->widgets;
    }
    
    function getFields()
    {
        if ($this->fields===null)
        {
            $this->fields=array();            
            foreach ($this->getData() as $field=>$options)
            {
                $this->fields[]= is_numeric($field)?$options:$field;
            }    
        }   
        return $this->fields;
    }
    
   
    function process()
    {
        $this->data=array('status'=>'ok');                
        foreach ($this->getData() as $field=>$options)
        {                     
          //  echo "Field=".$field."<br>";
           $this->getWidgets()->pushIf(is_numeric($field)?true:(isset($options['condition'])?$options['condition']:true), new mfWidgetApi($this->getItem(),is_numeric($field)?$options:$field, is_numeric($field)?array():$options));                                            
        }          
        $this->data['data']=$this->getWidgets()->toArray();          
        return $this;
    }
    
    function toArray()
    {                
        return $this->data;
    }
 
   
}
    
    
