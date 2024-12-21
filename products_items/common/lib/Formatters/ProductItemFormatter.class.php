<?php

class ProductItemFormatter extends mfFormatter {
     
     function getSalePrice()
    {
        return new FloatFormatter($this->getValue()->get('sale_price'));
    }
    
    function getSalePriceWithTax()
    {
        return new FloatFormatter($this->getValue()->getSalePriceWithTax());
    }
    
    function getDiscountPrice()
    {
        return new FloatFormatter($this->getValue()->getDiscountPrice());
    }
    
    function getDiscountPriceWithTax()
    {
        return new FloatFormatter($this->getValue()->getDiscountPriceWithTax());
    }
    
    
     function getSalePriceWithoutTax()
    {
        return new FloatFormatter($this->getValue()->getSalePriceWithoutTax());
    }
    
    function getPurchasingPrice()
    {
        return new FloatFormatter($this->getValue()->get('purchasing_price'));
    }
    
     function getCoefficient()
    {
        return new FloatFormatter($this->getValue()->get('coefficient'));
    }
    
     function getThickness()
    {
        return new FloatFormatter($this->getValue()->get('thickness'));
    }  
    
     function getInput3()
    {
        return new FloatFormatter($this->getValue()->get('input3'));
    } 
    
      function getMultiple()
    {
        return new FloatFormatter($this->getValue()->get('multiple'));
    }         
    
    function toArrayForQuotation()
    {
        return new mfArray(array(
            'sale_price_without_tax'=>$this->getValue()->getSalePriceWithoutTax(),
            'sale_price_with_tax'=>$this->getValue()->getSalePriceWithTax(),
        ));
    }
}
