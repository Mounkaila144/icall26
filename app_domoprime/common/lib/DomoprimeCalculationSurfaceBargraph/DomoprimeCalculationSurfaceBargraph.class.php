<?php


class DomoprimeCalculationSurfaceBargraph extends mfFormatter {
    
    
    
    
    function getPourcentage()
    {
        if ($this->getValue() > 100 )
            return 100;
        else
            return $this->getValue();
    }
    
    
    
}
