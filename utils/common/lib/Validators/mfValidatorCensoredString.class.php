<?php

class mfValidatorCensoredString extends mfValidatorString
{
   
 
     protected function configure($options = array(), $messages = array()) { 
        $this->addRequiredOption('callback', null);
        parent::configure($options, $messages);     
    }

    protected function doIsValid($value) {           
        $clean=parent::doIsValid($value);        
        if (is_callable($this->getOption('callback')))
        {
            $clean= call_user_func($this->getOption('callback'),$clean);
        }        
        return $clean;                  
    }
}
