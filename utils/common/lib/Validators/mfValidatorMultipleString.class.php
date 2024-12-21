<?php

class mfValidatorMultipleString extends mfValidatorRegex {
    
       protected $regex = '/^(.*\%s?)*$/i';

    protected function configure($options = array(), $messages = array()) { 
        $this->setOption('separator', ",");
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->setOption('pattern', sprintf($this->regex,$this->getOption('separator')));
        $this->setOption('remove_space',true);  
        $this->setOption('trim',false); 
         $this->setOption('empty_value', new mfArray());
    }

    protected function doIsValid($value) {           
        if ($this->getOption('remove_space'))
            $value=str_replace(" ","",$value);
        $clean= parent::doIsValid($value);       
        if ($this->getOption('trim'))
        {
            $values=new mfArray();
            foreach (explode($this->getOption('separator'),$clean) as $value)
                $values[]=trim($value);
        } 
        else
        {
           $values= new mfArray(explode($this->getOption('separator'),$clean)); 
        }    
        return $values;                  
    }

}