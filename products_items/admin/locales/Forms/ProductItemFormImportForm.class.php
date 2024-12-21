<?php

class ProductItemFormImportForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }

    
      function configure() {         
        $this->setValidators(array(              
            'file'=>new mfValidatorFile(array('max_size'=>1 * 1024 *1024,'mime_types'=>array('application/xml'))),
        ));  
    } 
    
    function getFile()
    {
        return new File($this['file']->getValue()->getTempName());
    }
}
