<?php

require_once dirname(__FILE__)."/TaxNewForm.class.php";

class TaxCollectionNewForm extends mfFormSite {

    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure() {         
        $this->setDefault('count', $this->getDefault('count',2)); // Number of form fields by default 
        $this->setValidator('count',new mfValidatorInteger(array('min'=>1,"max"=>10)));     
        $this->embedFormForEach('collection',new TaxNewForm(array(),$this->site),$this->getDefault('count')); 
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        $checkin=array();
        $error=false;        
        if (!$this->getErrorSchema()->hasErrors())
            return $values;      
        foreach ($values['collection'] as $index=>$form)
        {          
            foreach ($form as $key=>$value)
            {
               try
               {                  
                  if (in_array($key,array('rate')) && $value!="")
                  {
                      if ($checkin[(string)$value]==true)
                          throw new mfValidatorError($this['collection'][$index]['rate']->getValidator(),__('This {key} [{value}] already exists in this form.'),array('key'=>$key,'value'=>$value));                     
                      $checkin[(string)$value]=true;
                  }                  
               }
               catch (mfValidatorError $e)
               {
                       $this['collection'][$index][$key]->setError($e);
                       $error=true;
               }
            }
        }
        if ($error)
           throw new mfValidatorErrorSchema($validator,array("collection"=>new mfValidatorError($validator,"error")));  // Dummy Exception with no error
        return $values;
    }
}