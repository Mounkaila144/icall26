<?php

class CustomerMeetingExportKML {
    
    protected $meeting=null,$output="";
    
    function __construct($meeting) 
    {
        $this->meeting=$meeting;
    }
    
    function build()
    {
        $placemark=new GoogleKmlPlacemark($this->meeting->getTime("H:i")."H ".(string)$this->meeting->getCustomer(),$this->meeting->getCustomer()->getAddress()->getCoordinates());        
        $folder=new GoogleKmlFolder($this->meeting->getDateI18nInWord());
        $folder->addItem($placemark);       
        $document=new GoogleKmlDocument("rdv-".$this->meeting->getDayTime()->getDate("d-m-Y").".kmz");
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
         return "rdv-".$this->meeting->getDayTime()->getDate("d-m-Y")."-".$this->meeting->getCustomer()->getNameForFile().".kml";
    }
        
}