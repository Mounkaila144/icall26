<?php


abstract class DomoprimeQuotationEngineCore {
     
    protected $quotation=null,$calculation=null,$user=null,$prime=0,$number_of_people=0,$debug=false,
              $tax_credit_used=0,$request=null,$number_of_children=0,$site=null,$options=array(),
              $rest_in_charge=0.0,$tax_credit_limit=0.0,$rest_in_charge_after_credit=0.0;    
    
    abstract function process();
    
    abstract function create(mfForm $form,User $user);
    
    abstract function update(mfForm $form,User $user);
    
    function __construct($quotation,$options=array()) {       
        $this->quotation=$quotation;
        $this->site=$quotation->getSite();
        $this->user=$quotation->getCreator();
        $this->settings=new DomoprimeSettings(null,$this->getSite()); 
        $this->options=$options;
        $this->configure();
    }
    
    function setOption($name,$value) 
    {
        $this->options[$name]=$value;
        return $this;
    }
    
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function configure()
    {
        
    }
       
    function getSettings()
    {
        return $this->settings;
    }
    
    function getQuotation()
    {
        return $this->quotation;
    }
    
    
     function getPrime()
    {
        return $this->prime;
    }
    
    function hasPrimeOneEuro()
    {
        return $this->has_prime_one_euro;
    }
    
    function getTaxCredit()
    {
        return $this->tax_credit;
    }
    
    function getNumberOfPeople()
    {
        return $this->number_of_people;
    }
    
     function getNumberOfChildren()
    {
        return $this->number_of_children;
    }
    
    
     function getRestInCharge()
    {
        return $this->rest_in_charge;
    }
    
    function getTaxCreditUsed()
    {
        return $this->tax_credit_used;
    }
    
    function getCalculation()
    {
        return $this->calculation;
    }
    
    
     function getRestInChargeAfterCredit()
    {
        return $this->rest_in_charge_after_credit;
    }
    
    function getTaxCreditLimit()
    {
        return $this->tax_credit_limit;
    }
    
    function getEngineName()
    {
        return "Core";
    }
    
    function debug()
    {
        $this->debug=true;
        return $this;
    }
    
    function isDebug()
    {
        return $this->debug;
    }
    
    function getDataForProductQuotation()
    {
        return array();
    }
    
     function updateProducts(mfArray $items,mfArray $quantities)
     {
         
         return $this;
     }
     
      function beforeSaveQuotation()
      {
         return $this;
      }
}
