<?php


class PartnerPolluterClassCollectionXmlExtractor extends  XmlFileToObject {
   
    
    
    
    function getXmlFile()
    {
        return "pricings.xml";
    }
    
    function getPolluter()
    {
        return $this->object;
    }
    
    /*function setValuesFromXML($xml)
    {        
        $this->values=$xml->pricing;
        return $this;
    }*/
    
    function extract()
    {         
       if (!$this->toArray())
           return $this;
      // Pricings   
       $names=new mfArray();
       foreach ($this->toArray()->getValue('pricing') as $pricing)       
          $names[]=(string)$pricing->class->name;           
       $classes=DomoprimeClass::getClassesByNames($names);        
       $pricings= new DomoprimePolluterClassPricingCollection(null, $this->getSite());  
       foreach ($this->toArray()->getValue('pricing') as $price)
       {                    
          $pricing= new DomoprimePolluterClassPricing(null, $this->getSite());
          $pricing->add($price);
          $pricing->set('polluter_id',$this->getPolluter());
          $pricing->set('class_id',$classes[in_array((string)$price->class->name,array('',' '))?"NULL":(string)$price->class->name]);
          $pricings[]=$pricing;
       }
       $pricings->save();     
       return $this;                        
    }
}
