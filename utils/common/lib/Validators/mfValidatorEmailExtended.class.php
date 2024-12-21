<?php

class mfValidatorEmailExtended extends mfValidatorEmail {
    
    
    protected function configure($options = array(), $messages = array()) {    
        parent::configure($options, $messages);
        $this->setOption('trap_invalid', false);
        $this->setOption('return_invalid', "");
    }

    protected function doIsValid($value) {       
        if (strpos($value, "@") === false)
        {
            if ($this->getOption('trap_invalid',false))
                return $this->getOption ('return_invalid');
            throw new mfValidatorError($this, '@', array('value' => $value));
        }
        try
        {
            $clean = parent::doIsValid($value);
        }
        catch (mfValidatorError $e)
        {
              if ($this->getOption('trap_invalid',false))
                  return $this->getOption ('return_invalid');
              throw $e;
        }
        return $clean;
    }

}