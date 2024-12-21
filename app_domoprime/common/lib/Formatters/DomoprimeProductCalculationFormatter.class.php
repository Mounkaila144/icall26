<?php


class DomoprimeProductCalculationFormatter extends mfFormatter {
     

    function getSurface()
    {
        return format_number($this->getValue()->get('surface'),"#");
    }
    
    function getCumacValue()
    {
        return format_currency($this->getValue()->get('qmac_value'),"EUR");
    }
    
     function getCumac()
    {
        return format_number($this->getValue()->get('qmac'),"#");
    }
    
    
    function getSurfaceBargraph()
    {
        return new DomoprimeProductCalculationSurfaceBargraph($this->getValue()->get('surface'));
    }
}
