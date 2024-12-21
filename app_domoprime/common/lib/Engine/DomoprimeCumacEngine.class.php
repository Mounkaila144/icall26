<?php


 class DomoprimeCumacEngine {
  
     protected $site=null,$settings=null,$engine=null;
     static $instance =null;
     
     static function getInstance($site=null)
     {
         return self::$instance=self::$instance===null?new self($site):self::$instance;
     }
     
     function __construct($site=null) {
         $this->site=$site;       
         $this->settings=new DomoprimeSettings(null,$site);
     }
     
     function getSite()
     {
         return $this->site;
     }
     
     function getSettings()
     {
         return $this->settings;
     }
     
     function getClass()
     {
         $class=$this->getSettings()->getCumacEngine();
        if (!class_exists($class))
            throw new mfException(__("Cumac engine is invalid.")); 
        return $class;
     }
         
     function getEngine($data)
     {      
           $class=$this->getClass();
           $this->engine= new $class($data);
           return $this->engine;       
     }
 }