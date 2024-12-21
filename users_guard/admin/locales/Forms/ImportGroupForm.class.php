<?php

class ImportGroupForm extends mfForm {

   function configure() { 
        $this->setValidators(array(
            'name'=>new mfValidatorName(array('trim'=>true)),
            'file'=>new mfValidatorFile(array(     
                                                         'mime_types'=>array( 'text/plain','text/csv', 'text/comma-separated-values'),
                                                          'max_size'=>1 * 1024 *1024,
                                                 )),
        ));
    }

    
    function getFile()
    {
        return $this['file']->getValue();
    }
}