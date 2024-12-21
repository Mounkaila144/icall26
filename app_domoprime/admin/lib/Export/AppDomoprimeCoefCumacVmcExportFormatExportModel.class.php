<?php

class AppDomoprimeCoefCumacVmcExportModel extends mfExportFormatModelCell  {
       
    function __construct() {                          
        parent::__construct('DomoprimeCustomerRequest');       
    }       
    
     function __toString() {
        return __("coefficient cumac vmc",array(),'fields','app_domoprime_iso');
    }
    
     function processCell($item)
    {              
          // surface_home   
        if ($item->getHomeSurface() >= 0 && $item->getHomeSurface() <= 34) 
        {
            $this->output="0.3";
            return $this;
        }
        if ($item->getHomeSurface() >= 35 && $item->getHomeSurface() <= 59) 
        {
            $this->output="0.5";
            return $this;
        }
        if ($item->getHomeSurface() >= 60 && $item->getHomeSurface() <= 69) 
        {
            $this->output="0.6";
            return $this;
        }
        if ($item->getHomeSurface() >= 70 && $item->getHomeSurface() <= 89) 
        {
            $this->output="0.7";
            return $this;
        }
        if ($item->getHomeSurface() >= 90 && $item->getHomeSurface() <= 109) 
        {
            $this->output="1.0";
            return $this;
        }
        if ($item->getHomeSurface() >= 110 && $item->getHomeSurface() <= 129) 
        {
            $this->output="1.1";
            return $this;
        }
         if ($item->getHomeSurface() >= 130) 
        {
            $this->output="1.6";
            return $this;
        }     
        return $this;
    }       
}
