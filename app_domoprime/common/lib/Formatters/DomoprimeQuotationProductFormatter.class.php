<?php


class DomoprimeQuotationProductFormatter extends mfFormatter {
    
     
    
    function getCreatedAt()
    {
        return new DateTimeFormatter($this->getValue()->get('created_at'));
    }
    
     function getSalePriceWithTax()
    {
        return format_number($this->getValue()->getSalePriceWithTax(),'#.00');    
    }
    
     function getTotalPriceAndAdderWithTax()
    {
        return format_number($this->getValue()->getTotalPriceAndAdderWithTax(),'#.00');    
    }
    
    function getPriceAndAdderWithTax()
    {
        return format_number($this->getValue()->getPriceAndAdderWithTax(),'#.00');    
    }
}
