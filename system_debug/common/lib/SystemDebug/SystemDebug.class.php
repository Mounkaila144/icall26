<?php


class SystemDebug {
    
    static protected $instance=null;
    
    protected $messages=null;
    
    static function getInstance()
    {
       if (self::$instance===null)
           self::$instance=new static();
       return self::$instance;
    }
    
    function __construct() {
        $this->messages=new mfArray();
    }
    
    function addMessage($message)
    {
        $this->messages[]=$message;
        return $this;
    }
    
    function addMessages($messages)
    {
        $this->messages->merge(new mfArray($messages));
        return $this;
    }
    
    function getMessages()
    {
        return $this->messages;
    }
    
    function dump($var)
    {
         $this->messages[]=var_export($var,true);
         return $this;
    }
    
    function var_dump($var)
    {
        if (is_array($var))
        {                
             $this->messages[]=$this->displayArray($var)->implode('');
        }    
        return $this;
    }
    
    protected function displayArray($var)
    {
        $values=new mfArray();
        $values[]="<ul>";
        foreach ($var as $name=>$value)  
        {
            if (is_array($value))
                $values[]=$name." => ".$this->displayArray($value)."";   
            else    
                $values[]="<li>".$name." => ".$value."</li>";        
        }          
        $values[]='</ul>';
        return $values;
    }        
    
    function trace()
    {
        
    }
}
