<?php

class mfValidatorVariablesForImport extends mfValidatorRegex {
    
    protected $regex = '/^((.*)\%s?)?$/i';

    protected function configure($options = array(), $messages = array()) { 
        $this->setOption('separator', "|");
        $this->setOption('upper', false);
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->setOption('pattern', sprintf($this->regex,$this->getOption('separator')));
        $this->setOption('remove_space',false);
    }

    protected function doIsValid($value) {       
        $clean = parent::doIsValid($value);       
        if ($this->getOption('remove_space'))
            $clean=str_replace(" ","",$clean);
        if ($this->getOption('upper'))
            $clean=strtoupper($clean);
        $clean=explode($this->getOption('separator'),$clean);             
        return $clean;
    }

}