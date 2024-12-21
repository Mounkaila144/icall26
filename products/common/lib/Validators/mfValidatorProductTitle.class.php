<?php

class mfValidatorProductTitle extends mfValidatorRegex {
  
   const REGEX_NAME="/^[\w \'\.,%]+$/u"; 
   ///[0-9a-zA-Z]+/w"; //"#^[a-zA-Z0-9_]+$/u#"; //"/[0-9a-zA-Z]+/u"; //"/^[0-9][\w]+/u";

    protected function configure($options = array(), $messages = array()) {    
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->setOption('pattern', self::REGEX_NAME);
    }

    protected function doIsValid($value) {
        $clean = parent::doIsValid($value);
        return $clean;
    }
    
}