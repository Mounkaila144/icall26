<?php

class CustomersImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/customers";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);    
        $this->addDefaults(array('country'=>CustomerSettings::load($this->getSite())->get('default_country')));
        $this->setValidators(array(
            "gender"=>new mfValidatorChoice(array('choices'=>array('Mr','Ms','Mrs'),'required'=>false,'empty_value'=>'Mr')),
            "lastname"=>new mfValidatorString(array("max_length"=>"255")),
            "firstname"=>new mfValidatorString(array("max_length"=>"255")),
            "phone"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "mobile"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "address1"=>new mfValidatorString(array("max_length"=>"255")),
            "address2"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "email"=>new mfValidatorEmail(array("max_length"=>"255","required"=>false)),
            "postcode"=>new mfValidatorString(array("max_length"=>"255")),
            "city"=>new mfValidatorString(array("max_length"=>"255")), 
            "country"=>new mfValidatorString(array("max_length"=>"2","min_length"=>"2","required"=>false)) 
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getCustomer()
    {                          
        $item= new Customer(array('lastname'=>(string)$this['lastname'],'firstname'=>(string)$this['firstname']),$this->getSite());        
        $item->add($this->getValues());           
        $item->getAddress()->add(array('address1'=>(string)$this['address1'],
                                       'address2'=>(string)$this['address2'],
                                       'postcode'=>(string)$this['postcode'],
                                       'city'=>(string)$this['city'],
                                       'country'=>(string)$this['country']
                    ));      
                
        return $item;
    }
    
   
    
}
