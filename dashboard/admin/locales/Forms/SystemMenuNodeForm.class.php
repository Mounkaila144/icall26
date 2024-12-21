<?php


class SystemMenuNodeForm extends mfForm {
     function __construct($language)
    {
       $this->language=$language;           
       parent::__construct();      
    }
    
    
      protected $node=null;
            
    function configure()
    {
        $this->setValidators(array(
            'node'=>new mfValidatorInteger(array('required'=>false)),           
            'lang'=>new LanguagesExistsValidator(array(),'frontend'),          
        ));      
    }        
    
    function getNode()
    {       
        
       if ($this->node===null)
       {    
        if ($this['node']->getValue())       
            $this->node=new SystemMenu($this['node']->getValue());         
        else
            $this->node=new SystemMenu('root');
       } 
        return $this->node;     
    }
    
    function getLanguage()
    {       
        return $this['lang']->getValue();       
    }
    
    
     
}

