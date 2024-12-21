<?php


class DomoprimeQuotationProductItemFormatter extends mfFormatter {
    
     
    
    function getCreatedAt()
    {
        return new DateTimeFormatter($this->getValue()->get('created_at'));
    }
    
     function getTotalSalePriceWithTax()
    {
        return format_number($this->getValue()->getTotalSalePriceWithTax(),'#.00');    
    }
    
     function getTotalSalePriceWithoutTax()
    {
        return format_number($this->getValue()->getTotalSalePriceWithoutTax(),'#.00');    
    }
    
     function getSalePriceWithTax()
    {
        return format_number($this->getValue()->getSalePriceWithTax(),'#.00');    
    }
    
     function getSalePriceWithoutTax()
    {
        return format_number($this->getValue()->getSalePriceWithoutTax(),'#.000');    
    }
    
     function getQuantity()
    {
        return new FloatFormatter($this->getValue()->getQuantity());    
    }
    
     
    
    
      
}
