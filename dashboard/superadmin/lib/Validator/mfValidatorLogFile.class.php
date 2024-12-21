<?php

class mfValidatorLogFile extends mfValidatorRegex {
    
    const REGEX_LOGFILE = '/^20[0-9][0-9]_[0-9][0-9]_[0-9][0-9]_system_error_/';

    protected function configure($options = array(), $messages = array()) {    
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->addMessage('file', "file [{value}] doesn't exist");
        $this->setOption('pattern', self::REGEX_LOGFILE);
    }

     protected function doIsValid($value) {
        $clean = parent::doIsValid($value);
        $log=new logFile($clean.".log");   
        if (!$log->isExist())
          throw new mfValidatorError($this, "file",array("value"=>$value.".log"));            
        return $log;
    }

}