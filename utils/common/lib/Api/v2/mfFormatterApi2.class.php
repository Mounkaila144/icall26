<?php

abstract class mfFormatterApi2 {
    
    static protected $site=null;
    
    protected $data,$client=null,$theme_api=null,$directory="";
           
    
    function __construct() {         
        $this->user = mfcontext::getInstance()->getUser();
        $this->data=new mfArray();
        if (self::$site===null)
            self::$site=mfcontext::getInstance()->getRequest()->getSite();       
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
    
     function getData()
    {
        return $this->data;
    }
    
        
    function getUser()
    {
        return $this->user;
    }
    
    
   /* function getFields()
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
    }*/
    
   
    function process()
    {        
       return $this;
    }
    
    function toArray()
    {                
        return $this->data->toArray();
    }
 
   
}
    
    
