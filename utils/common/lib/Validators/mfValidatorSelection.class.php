<?php

class mfValidatorSelection extends mfValidatorRegex {
    
    protected $regex = '/^([0-9]*\%s?)*$/i';

    protected function configure($options = array(), $messages = array()) { 
        $this->setOption('separator', ",");
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->setOption('pattern', sprintf($this->regex,$this->getOption('separator')));
        $this->setOption('remove_space',true);        
    }

    protected function doIsValid($value) {       
        $clean = parent::doIsValid($value);       
        if ($this->getOption('remove_space'))
            $clean=str_replace(" ","",$clean);
        $clean=explode($this->getOption('separator'),$clean);             
        return $clean;
    }

}