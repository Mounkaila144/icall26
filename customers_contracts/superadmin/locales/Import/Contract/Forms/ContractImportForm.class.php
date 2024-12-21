<?php

class ContractImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/contracts";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "date"=>new mfValidatorI18nDate(array("date_format"=>"a")),
            "phone"=>new mfValidatorString(array("max_length"=>"20")),           
            "product"=>new mfValidatorString(array("max_length"=>"255")),
            "details"=>new mfValidatorString(array("max_length"=>"255","required"=>false)), 
            "amount"=>new mfValidatorString(array("max_length"=>"10","required"=>false)),
            "sale1"=>new mfValidatorString(array("max_length"=>"50","required"=>false)),         
            "sale2"=>new mfValidatorString(array("max_length"=>"50","required"=>false)),          
            "status"=>new mfValidatorString(array("max_length"=>"50")),       
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getContract()
    {                          
        $item= new CustomerContract(array('customer'=>$this->getCustomer(),
                                          'product'=>$this->getProduct(),
                                          'total_price_with_taxe'=>(string)$this['amount'],
                                          'opened_at'=>(string)$this['date']
                                    ),$this->getSite());        
       // $item->add($this->getValues());        
        return $item;
    }
    
     function getStatusI18n()
    {                          
        $item= new CustomerContractStatusI18n(array('name'=>(string)$this['status']),$this->getSite());                
        return $item;
    }
    
    function getProduct()
    {                          
        $item= new Product(array('meta_title'=>(string)$this['product']),$this->getSite());                
        return $item;
    }
    
    function getCustomer()
    {                          
        $item= new Customer(array('phone'=>(string)$this['phone']),$this->getSite());                
        return $item;
    }
    
    function getSale1()
    {                          
        $item= new User((string)$this['sale1'],'admin',$this->getSite());                
        return $item;
    }
    
    function hasSale1()
    {
        return $this['sale1']->getValue();
    }
    
    function getSale2()
    {                          
        $item= new User((string)$this['sale2'],'admin',$this->getSite());                
        return $item;
    }
    
    function hasSale2()
    {
        return $this['sale2']->getValue();
    }
    
    
}
