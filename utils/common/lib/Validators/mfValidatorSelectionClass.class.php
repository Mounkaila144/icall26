<?php

class mfValidatorSelectionClass extends mfValidatorRegex {
    
    protected $regex = '/^((.*)\%s?)?$/i';

    protected function configure($options = array(), $messages = array()) { 
        $this->setOption('separator', ",");               
        $this->setMessage('invalid', $this->translateMessages("'{value}' is invalid."));
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->setOption('pattern', sprintf($this->regex,$this->getOption('separator')));       
        $this->addOption('trim',true);  
        $this->setOption('empty_value',array());
        if (!class_exists($options['class']))
        {    
            throw new InvalidArgumentException(sprintf("%s class doesn't exist on object: '%s'.",$options['class'], $this->getValidatorName())); 
        }
        $this->setOption('class',$options['class']);   
        $this->setOption('options',$options['options']);
          // var_dump($this->options['required']);
    }
        
    
    protected function doIsValid($values) {          
        $values=parent::doIsValid($values);      
        $cleans=array();
        $class=$this->getOption('class');   
        $errors=array();         
        foreach (explode($this->getOption('separator'),$values) as $value)
        {                   
            try
            {
                $validator=new $class($this->getOption('options'));
                $clean=$validator->isValid($value);
                if ($this->getOption('trim',true))                    
                        $cleans[]=trim($clean);  
                else
                    $cleans[]=$clean;   
            } 
            catch (mfValidatorError $e) 
            {
               $errors[]= $value;
            }
        }
        if ($errors)
        {
            throw new mfValidatorError($this, 'invalid', array('value' => implode(",",$errors)));    
        }                    
        return $cleans;
    }

}