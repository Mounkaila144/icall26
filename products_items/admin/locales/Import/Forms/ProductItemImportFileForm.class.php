<?php

class ProductItemImportFileForm extends mfForm {

    
    function configure() { 
        $this->setValidators(array(      
           'file'=>new mfValidatorFile(array('max_size'=>5 * 1024 *1024,'mime_types'=>array( 'text/plain','text/csv', 'text/comma-separated-values')))
         //   'file'=>new mfValidatorZipFile(array('max_size'=>5 * 1024 *1024)),                    
                ));       
    }
    
    function getFile()
    {        
       return $this->getValue('file')->getTempName(); // Site Save in archive                                     
    }
    
}