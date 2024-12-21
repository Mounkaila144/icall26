<?php


class ProductItemItemPositionsForm extends mfForm {
        
    protected $item=null;
     
    
    function __construct(ProductItem $item,$defaults = array(), $options = array()) {
        $this->item=$item;
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

