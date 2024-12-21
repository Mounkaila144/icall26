<?php


class DomoprimeCalculationReportFormatter extends DomoprimeCalculationFormatter {
    
    
      
   function getSurfaceBargraph()
    {
        return new DomoprimeCalculationSurfaceBargraph($this->getValue()->getTotalSurface());
    }
    
    function getTotalCumac()
    {      
       return format_currency($this->getValue()->get('qmac'),"EUR");         
    }
    
    function getTotalCumacValue()
    {
      return  format_currency($this->getValue()->get('qmac_value'),"EUR");    
    }
}
