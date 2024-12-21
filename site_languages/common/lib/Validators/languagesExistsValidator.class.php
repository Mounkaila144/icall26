<?php

class languagesExistsValidator extends mfValidatorString {

    protected $site=null;
    
    function __construct($options,$application=null,$site=null)
    {
        $this->site=$site;
        $this->application=$application;
        parent::__construct($options);        
    }
    
    protected function getSite()
    {
        return $this->site;
    }
    
    protected function getApplication()
    {
        return $this->application;
    }
    
    protected function configure($options,$messages)
    { 
       parent::configure($options,$messages);
       $this->setOption("empty_value",0); // in case of value is null
       $this->addMessage('exist', __("record ({value}) doesn't exists."));
    }
  
    protected function doIsValid($value) 
    {        
        $item=new Language($value,$this->getApplication(),$this->getSite());
        if ($item->isNotLoaded())
        {
           if ($this->getOption('required')==true)
               throw new mfValidatorError($this, 'required');
           else              
              return $item;
           throw new mfValidatorError($this, 'exist', array('value' => $value));
        }
        return $item;
    }

}
