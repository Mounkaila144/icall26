<?php


class AppDomoprimeExportClassEnergySectorModel extends AppDomoprimeExportFormatExportModel  {
    
    
    
    function __toString() {
        return __("Class/Energy/Zone",array(),'fields','app_domoprime');
    }
    
  
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           $this->output="";
           if ($items->hasDomoprimeClassI18n() && $items->hasDomoprimeEnergyI18n() && $items->hasDomoprimeSector())
           {
             $this->output= mb_strtoupper((string)$items->getDomoprimeClassI18n().":".(string)$items->getDomoprimeEnergyI18n().":".(string)$items->getDomoprimeSector());                                    
           }                 
       }          
       return $this;
    }
    
    function getClass()
    {
        return "DomoprimeCalculation";
    } 
}
