<?php

require_once dirname(__FILE__)."/CustomerMeetingProductNewForm.class.php";

class ProductsMultipleNewForm extends mfForm {

 
    
    function configure() { 
       $settings=ProductSettings::load();        
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
            'count'=>new mfValidatorInteger(array('min'=>1,"max"=>10)),   // min/max form fields           
        ));
        $this->embedFormForEach('collection',new CustomerMeetingProductNewForm(array()),$this->getDefault('count')); 
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkProducts'))));
    }
    
    function checkProducts($validator,$values)
    {
        
        return $values;
    }
    
    
}