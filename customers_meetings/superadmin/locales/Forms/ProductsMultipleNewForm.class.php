<?php

require_once dirname(__FILE__)."/CustomerMeetingProductNewForm.class.php";

class ProductsMultipleNewForm extends mfFormSite {

   function __construct($defaults = array(),  $site = null) {
       parent::__construct($defaults, array(), $site);
   }
    
    function configure() 
    {                         
        $settings=ProductSettings::load($this->getSite());        
        if (!$this->hasDefaults() && $settings->hasDefaultProducts())
        {                        
            $this->setDefault('count',$settings->getDefaultProducts()->count());
            $this->setDefault('collection',$settings->getDefaultProducts()->toArray());              
        }    
        else
        {                          
            $this->setDefault('count', $this->getDefault('count',1)); // Number of form fields by default                
        }              
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(array('min'=>1,"max"=>10,'required'=>false)),   // min/max form fields           
        ));        
        $this->embedFormForEach('collection',new CustomerMeetingProductNewForm(array(),$this->getSite()),$this->getDefault('count')); 
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkProducts'))));       
    }
    
    function checkProducts($validator,$values)
    {
        
        return $values;
    }
  
}