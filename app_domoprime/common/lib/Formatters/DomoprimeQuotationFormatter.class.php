<?php


class DomoprimeQuotationFormatter extends mfFormatter {
    
    protected $settings=null;
    
    function __construct(DomoprimeQuotation $value = null) {
        parent::__construct($value);
        $this->settings=DomoprimeSettings::load($value->getSite());
    }
    
    function getCreatedAt()
    {
        return new DateTimeFormatter($this->getValue()->get('created_at'));
    }
    
     function getSignedAt()
    {
        return new DateTimeFormatter($this->getValue()->get('signed_at'));
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
    
     function getFixedPrime()
    {
        return new FloatFormatter($this->getValue()->getFixedPrime(),'#.00'); 
    }
    
     function getDiscountAmount()
    {
        return new FloatFormatter($this->getValue()->getDiscountAmount(),'#.00'); 
    }
    
       function getRestInCharge()
    {
        return format_number($this->getValue()->getRestInCharge(),'#.00'); 
    }  
    
      function getRestInChargeAfterCredit()
    {
        return format_number($this->getValue()->getRestInChargeAfterCredit(),'#.00'); 
    }  
    
      function getTaxCreditLimit()
    {
        return format_number($this->getValue()->getTaxCreditLimit(),'#.00'); 
    }  
    
    function getNumberOfPeople()
    {
        return format_number($this->getValue()->getNumberOfPeople(),'#.00'); 
    }
    
     function getNumberOfChildren()
    {
        return format_number($this->getValue()->getNumberOfChildren(),'#.00'); 
    }
    
    function getRestToPayWithTax()
    {
        return  format_number($this->getValue()->getRestToPayWithTax(),'#.00'); 
    }
    
    function getTotalSaleAndAdderAndFeeWithoutTax()
    {
        return format_number($this->getValue()->getTotalSaleAndAdderAndFeeWithoutTax(),'#.00'); 
    }
    
    function getTotalSaleAndAdderAndFeeTax()
    {
       return format_number($this->getValue()->getTotalSaleAndAdderAndFeeTax(),'#.00');  
    }
    
    function getTotalSaleAndAdderAndFeeWithTax()
    {
        return format_number($this->getValue()->getTotalSaleAndAdderAndFeeWithTax(),'#.00');  
    }
    
    function getTotalPrimeAndAdderAndFeeAndRestInChargeWithTax()
    {
          return format_number($this->getValue()->getTotalPrimeAndAdderAndFeeAndRestInChargeWithTax(),'#.00');  
    }
    
    function getTotalAddedWithTax()
    {
      return format_number($this->getValue()->getTotalAddedWithTax(),'#.00');    
    }
    
    function getTotalSaleAndAdderTax()
    {
        return format_number($this->getValue()->getTotalSaleAndAdderTax(),'#.00');    
    }
    
    function getFeeFile()
    {
       return format_number($this->getValue()->getFeeFile(),'#.00');    
    }
    
    function getTotalTaxFeeFile()
    {
       return format_number($this->getValue()->getTotalTaxFeeFile(),'#.00');     
    }
    
      function getAnaPrime()
    {
        return $this->getValue()->getAnaPrime();
    }
    
   
    function getAvanceWithTax()
    {
         return $this->getValue()->getAvanceWithTax();
    }
    
    function getAnaTax()
    {
         return $this->getValue()->getAnaTax();
    }
    
    
    function getTotalSaleAndPrimeAndAnaWithTax()
    {
         return $this->getValue()->getTotalSaleAndPrimeAndAnaWithTax();
    }
    
    function getAnaPackTax()
    {
         return $this->getValue()->getAnaPackTax();
    }
    
    function  getPackPrime()
    {
         return $this->getValue()->getPackPrime();
    }
    
    function  getItePrime()
    {
        return $this->getValue()->getItePrime();
    }
    
    function  getTotalSaleWithITEPrime()
    {
       return $this->getValue()->getTotalSaleWithITEPrime();
    }
    
    function  getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax()
    {
        return $this->getValue()->getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTax(); 
    }
    
    function getTotalSaleWithITEPrimeAndAnaPrime()
    {
       return $this->getValue()->getTotalSaleWithITEPrimeAndAnaPrime();  
    }
    
   
    
    function getRestInChargeWithTax()
    {
        return $this->getValue()->getRestInChargeWithTax();
    }
    
    function getTotalSaleWithTax()
    {
         return $this->getValue()->getTotalSaleWithTax();
    }
    
     function getTotalSaleWithoutTax()
    {
        return $this->getValue()->getTotalSaleWithoutTax();              
    }
    
    function getTotalSaleAndPrimeWithTaxAndDiscount()
    {
        return $this->getValue()->getTotalSaleAndPrimeWithTaxAndDiscount();
    }
    
    function getRestInChargeAndDiscount()
    {
        return $this->getValue()->getRestInChargeAndDiscount();
    }
    
    function getTotalSaleAndItePrimeAndDiscount()
    {
        return $this->getValue()->getTotalSaleAndItePrimeAndDiscount();
    }
    
    function getTotalSaleAndPackPrimeAndDiscount()
    {
        return $this->getValue()->getTotalSaleAndPackPrimeAndDiscount();
    }
    
    function getTotalSaleWithTaxAndDiscount()
    {
        return  $this->getValue()->getTotalSaleWithTaxAndDiscount();
    }
    
     function getTotalSaleWithITEPrimeAndAnaPrimeAndDiscount()
    {
        return $this->getValue()->getTotalSaleWithITEPrimeAndAnaPrimeAndDiscount();
    }
    
    function getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount()
    {
        return $this->getValue()->getTotalSaleAndPrimeAndPackPrimeAndAnaAndAnaPackWithTaxAndDiscount();
    }
    
    
    function getTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount()
    {
        return format_number($this->getValue()->getTotalSaleAndCeeAndBBCAndSubventionWithTaxAndDiscount(),'#.00');  
    }
    
   
    function getTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount()
    {
        return format_number($this->getValue()->getTotalSaleAndCeeAndAnahBBCAndSubventionWithTaxAndDiscount(),'#.00');  
    }
    
    
    function getTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount()
    {
       return format_number($this->getValue()->getTotalSaleAndAnahBBCAndSubventionWithTaxAndDiscount(),'#.00');  
    }
    
    
     function toArrayForApi2()
    {
       $values=$this->getValue()->toArray();        
       $values['products']=$this->getValue()->getProductsWithItems()->toArrayForQuotationApi2();  
       //$values['master']=$quotation->getProductsWithItems()->hasMaster()?$quotation->getProductsWithItems()->getMaster()->toArrayForQuotation():"";     
       return $values;
    }
    
     function toArrayForHook()
    {
       $values=$this->getValue()->toValues();        
       $values['products']=$this->getValue()->getProductsWithItems()->toArrayForHook();  
       $values['url']=url_to('app_domoprime_api2',['action'=>'ExportPdfQuotation'],'admin','')."?quotation=".$this->getValue()->get('id');
       //$values['master']=$quotation->getProductsWithItems()->hasMaster()?$quotation->getProductsWithItems()->getMaster()->toArrayForQuotation():"";     
       return $values;
    }
}
