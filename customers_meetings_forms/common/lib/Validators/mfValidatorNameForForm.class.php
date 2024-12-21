<?php

class mfValidatorNameForForm extends mfValidatorString {
     
    protected function configure($options = array(), $messages = array()) {    
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));       
    }

    protected function doIsValid($value) {        
        $clean=preg_replace("/[^A-Z0-9_]/i","", mfTools::I18N_noaccent(parent::doIsValid($value)));        
        return $clean;
    }
    
}