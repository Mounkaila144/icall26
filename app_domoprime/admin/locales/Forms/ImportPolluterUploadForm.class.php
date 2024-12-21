<?php


class ImportPolluterUploadForm extends mfForm {
    
    
    function configure() {
        $this->setValidators(array(
            "file"=>new mfValidatorFile(array('max_size'=>64 * 1024 * 1024,'mime_types'=>array("application/zip"))), 
        ));
    }
    
    function getOptions()
    {
        $values=$this->getValues();
        unset($values['file']);
        return $values;
    }
}
