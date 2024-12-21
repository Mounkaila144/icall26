<?php

class mfValidatorFileOrVariablesForImport extends mfValidatorVariablesForImport {
    
    
    protected function configure($options = array(), $messages = array()) {
        parent::configure($options, $messages);
        $this->addMessage('cant_read', $this->translateMessages('file {file} is not readable.'));
    }
    
    
    protected function doIsValid($value) {      
        if (!is_string($value))
           throw new mfValidatorError($this, 'invalid');    
        // If file
        if (strpos($value,"/")!==false)      
        {        
            $file=new File($this->getOption('path').(strpos($value, "/")===false?"/":"").$value);      
            if (!$file->isExist())
                throw new mfValidatorError($this, 'cant_read');
            // check file size
            if ($this->hasOption('max_size') && $this->getOption('max_size') < (int) $file->getSize())
            {
              throw new mfValidatorError($this, 'max_size', array('max_size' => $this->getOption('max_size'), 'size' => (int) $value['size']));
            }      
            $mimeType = $this->getMimeType($file->getName(), $file->getMime());    
            // check mime type    
            if ($this->hasOption('mime_types') && $this->getOption('mime_types'))
            {     
              $mimeTypes = is_array($this->getOption('mime_types')) ? $this->getOption('mime_types') : $this->getMimeTypesFromCategory($this->getOption('mime_types'));      
              if (!in_array($mimeType, $mimeTypes))
                throw new mfValidatorError($this, 'mime_types', array('mime_types' => $mimeTypes, 'mime_type' => $mimeType));
            } 
            // Do traitment 
            return $file->getContent();
        }
        else
        {   // if text  
            return parent::doIsValid($value);
        }                      
    }

}