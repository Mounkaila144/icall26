<?php


class SystemMenuNodeForm extends mfForm {
  
    protected $_node=null,$language=null;
    
    function __construct($language)
    {
       $this->language=$language;           
       parent::__construct();      
    }
    
    function configure()
    {     
         
        $this->setValidators(array(          
            'node'=>new mfValidatorInteger(array('required'=>false)),           
            'lang'=>new LanguagesExistsValidator(array(),'frontend'),          
        ));      
    }        
    
    function getNode()
    {       
       if ($this->_node===null)
       {    
        if ($this['node']->getValue())       
            $this->_node=new SystemMenu($this['node']->getValue());         
        else
            $this->_node=new SystemMenu('root');
       } 
        return $this->_node;     
    }
    
    function getLanguage()
    {             
        if ($this->isValid())
            return $this['lang']->getValue();               
        else
            return $this->language;
    }
    
     
}

