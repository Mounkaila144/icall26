<?php

require_once dirname(__FILE__)."/CustomerContractProductNewForm.class.php";

class ProductsMultipleNewForm extends mfForm {

    protected $user=null;
    
    function __construct($user=null,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults, array());
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() { 
             
        $settings=ProductSettings::load();        
        if (!$this->hasDefaults() && $settings->hasDefaultContractProducts())
        {                        
            $this->setDefault('count',$settings->getDefaultContractProducts()->count());
            $this->setDefault('collection',$settings->getDefaultContractProducts()->toArray());              
        }    
        else
        {                          
            $this->setDefault('count', $this->getDefault('count',1)); // Number of form fields by default                
        }              
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(array('min'=>1,"max"=>10,'required'=>false)),   // min/max form fields           
        ));  
        $this->embedFormForEach('collection',new CustomerContractProductNewForm(array(),$this->getUser()),$this->getDefault('count')); 
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkProducts'))));
    }
    
    function checkProducts($validator,$values)
    {
        
        return $values;
    }
}