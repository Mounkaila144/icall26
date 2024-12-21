<?php


class DomoprimeSimulationFormatter extends mfFormatter {
    
    protected $settings=null;
    
    function __construct($value = null) {
        parent::__construct($value);
        $this->settings=new DomoprimeSettings(null,$value->getSite());
        $this->impot_settings=new ServiceImpotSettings(null,$value->getSite());
    }
    
    function getCreatedAt()
    {
        return new DateFormatter($this->getValue()->get('created_at'));
    }
    
    function getDatedAt()
    {
        return new DateFormatter($this->getValue()->get('dated_at'));
    }
    
    function getFormattedReference()
    {        
        $parameters=array('{id}'=>$this->getValue()->get('id'));
        return strtr($this->settings->get('quotation_reference_format'), $parameters);   
    }
    
    
    
    function getPrime()
    {
        return format_number($this->getValue()->getPrime(),'#.00'); 
    }  
    
       function getRestInCharge()
    {
        return format_number($this->getValue()->getRestInCharge(),'#.00'); 
    }  
    
      function getRestInChargeAfterCredit()
    {
        return format_number($this->getValue()->getRestInChargeAfterCredit(),'#.00'); 
    }  
    
    function getTaxCreditAmount()
    {
        
        return format_number($this->getValue()->getTotalSaleWithTax() * $this->impot_settings->get('rate',0.3),"#.00");
    }
    
     function getRestInChargeAfterPrime()
    {
        return format_number($this->getValue()->getTotalSaleWithTax() - $this->getValue()->getPrime(),'#.00'); 
    }  
    
      function getTaxCreditLimit()
    {
        return format_number($this->getValue()->getTaxCreditLimit(),'#.00'); 
    }  
    
    function getNumberOfPeople()
    {
        return format_number($this->getValue()->getNumberOfPeople(),'#'); 
    }
    
     function getNumberOfChildren()
    {
        return format_number($this->getValue()->getNumberOfChildren(),'#'); 
    }
    
      
     function getTaxCreditAvailable()
    {
        return format_currency($this->getValue()->get('tax_credit_avaiable'),"EUR");
    }
    
    
}
