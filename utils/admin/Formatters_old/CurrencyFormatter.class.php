<?php

class CurrencyFormatter extends FloatFormatter {
    
    protected $currency=null;
    
    function __construct($value = null,$currency='EUR') {
        $this->currency=$currency;
        parent::__construct($value);
    }
    
    function getCurrency()
    {
        return $this->currency;
    }
    
     function getSymbol()
     {
         return format_currency_symbol($this->currency);
     }
     
     function getText($format = "#") {
         return parent::getText($format);
     }
     
     function __toString() {
         return (string)$this->getText()." ".$this->getSymbol();
     }
}
