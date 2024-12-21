<?php


class DomoprimeCalculationFormatter extends mfFormatter {
    
     function getCreatedAt()
    {
        return new DateTimeFormatter($this->getValue()->get('created_at'));
    }
       
    
    function getBetaSurface()
    {
        return new FloatFormatter($this->getValue()->get('beta_surface'));
    }
    
    function getEconomy()
    {
        return new FloatFormatter($this->getValue()->get('economy')); 
    }
    
    function getCumacCoefficient()
    {
         return new FloatFormatter($this->getValue()->get('cumac_coefficient')); 
    }
    
    function getCumac()
    {
        return new FloatFormatter($this->getValue()->get('qmac')); 
    }
    
    function getTotalQmac()
    {
        return new FloatFormatter($this->getValue()->get('qmac'));
    }
   
     function getMinCee()
    {
        return new FloatFormatter($this->getValue()->get('min_cee')); 
    } 
    
     function getCoefSalePrice()
    {
        return new FloatFormatter($this->getValue()->get('coef_sale_price')); 
    }
    
    function getQuotationCoefficient()
    {
        return new FloatFormatter($this->getValue()->get('quotation_coefficient')); 
    }
    
    function getCefMinusCefProject()
    {
        return new FloatFormatter($this->getValue()->get('cef_cef_project'));
    }
    
     function getNumberOfQuotations()
    {
        return new FloatFormatter($this->getValue()->get('number_of_quotations'));
    }
    
      function getTotalPrime()
    {
        return new FloatFormatter($this->getValue()->get('prime'));
    }
    
      function getSubvention()
    {
        return new FloatFormatter($this->getValue()->getSubvention());
    }
    
    function getBBcSubvention()
    {
        return new FloatFormatter($this->getValue()->getBbcSubvention());
    }
    
    function getTotalAnaprime()
    {
        return new FloatFormatter($this->getValue()->getAnaPrime());
    }
        
    
     function getBudget()
    {
        return new FloatFormatter($this->getValue()->getBudget());
    }
    
    
     function getBudgetToAddTTC()
    {
        return new FloatFormatter($this->getValue()->getBudgetToAddTTC());
    }
    
      function getBudgetToAddHT()
    {
         return new FloatFormatter($this->getValue()->getBudgetToAddHT());
    }    
    
    function getPolluterPricing()
    {
       return new FloatFormatter($this->getValue()->getPolluterPricing());
    }
    
     function getTotalCeePrime()
    {
        return new FloatFormatter($this->getValue()->get('cee_prime'));
    }
}
