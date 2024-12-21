<?php


class PartnerFormatter extends mfFormatter {
      
    
    function getQualificationDate()
    {       
           return new DateFormatter($this->getValue()->getParameters()->getQualificationDate());
    }
    
    function getSoftWareDate()
    {      
          return new DateFormatter($this->getValue()->getParameters()->getSoftwareDate());     
    }
    
}
