<?php

class mfValidatorMultiple extends mfValidatorBase {
    
    protected $validator=null;
    
    function __construct(mfValidatorBase $validator,$options = array(), $messages = array()) {
        $this->validator=$validator;     
        parent::__construct($options, $messages);
    }
    protected function configure($options = array(), $messages = array()) { 
        $this->setOption('separator', ",");     
        $this->setOption('output','mfArray');
        $this->setOption('remove_space',true);          
        $this->setMessage('invalid', "{values}");                      
    }
    
    function getValidator()
    {
        return $this->validator;
    }

    protected function doIsValid($value) {              
        if ($this->getOption('remove_space'))
            $value=str_replace(" ","",$value);
        $data=new mfArray(explode($this->getOption('separator'),$value));           
        $validator=new mfValidatorSchemaForEach($this->validator,$data->count());
        try
        {
           $clean=$validator->isValid($data->toArray()); 
        } 
        catch (mfValidatorErrorSchema  $ex) 
        {                                  
            throw new mfValidatorError($this,'invalid', array('values' =>implode(',',$ex->getErrorsMessage())));
        }       
        if ($this->getOption('output')=='string')
            return $clean;
        $class=$this->getOption('output','mfArray');
        return new $class($clean);
        
    }

}