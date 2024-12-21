<?php

class CustomerMeetingMutualProductFormatter extends mfFormatter {
    
    function getSalePriceWithTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('sale_price_with_tax'));
    }
    
    function getPurchasePriceWithTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('purchase_price_with_tax'));
    }
    
    function getSalePriceWithoutTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('sale_price_without_tax'));
    }
    
    function getPurchasePriceWithoutTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('purchase_price_without_tax'));
    }
    
    function getTotalSalePriceWithTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('total_sale_price_with_tax'));
    }
    
    function getTotalPurchasePriceWithTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('total_purchase_price_with_tax'));
    }
    
    function getTotalSalePriceWithoutTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('total_sale_price_without_tax'));
    }
    
    function getTotalPurchasePriceWithoutTaxI18n()
    {
        return new FloatFormatter($this->getValue()->get('total_purchase_price_without_tax'));
    }
    
}
