<?php

class CustomerContractExportKML {
    
    protected $contract=null,$output="";
    
    function __construct($contract) 
    {
        $this->contract=$contract;
    }
    
    function build()
    {       
        $placemark=new GoogleKmlPlacemark($this->contract->getOpenedAtTime("h:i")."H ".(string)$this->contract->getCustomer(),$this->contract->getCustomer()->getAddress()->getCoordinates());        
        $folder=new GoogleKmlFolder($this->contract->getOpenedAtDateI18nInWord());
        $folder->addItem($placemark);       
        $document=new GoogleKmlDocument("rdv-".$this->contract->getOpenedAtDayTime()->getDate("d-m-Y").".kmz");
        $document->addItem($folder);
        $this->output=$document->output();     
    }
    
    function output()
    {       
        if (!$this->output)
            $this->build();
        return  $this->output;     
    }
    
    function getSize()
    {
        return mb_strlen($this->output);
    }
    
    function getName()
    {
         return __("customer")."-".$this->contract->getOpenedAtDayTime()->getDate("d-m-Y")."-".$this->contract->getCustomer()->getNameForFile().".kml";
    }
        
}