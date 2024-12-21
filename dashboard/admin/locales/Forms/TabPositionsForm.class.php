<?php


class TabPositionsForm extends mfForm {
        
    protected $item=null;
     
    
    function __construct($defaults = array(), $options = array()) {
        parent::__construct($defaults, $options);
    }

    function configure()
    {
       $this->setValidators(array(
           'positions'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('positions'))),
       ));
     
    }
      
   /* function getOrdered()
    {
        
        return $this->functions=$this->functions===null?EmployerFunction::getAllOrdered():$this->functions;
    }*/
    
     function getPositions()
    {
        return $this['positions']->getArray();
    }
    
    
}

