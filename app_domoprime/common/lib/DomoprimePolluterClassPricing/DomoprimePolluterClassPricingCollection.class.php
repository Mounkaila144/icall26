<?php


class DomoprimePolluterClassPricingCollection extends mfObjectCollection3 {
    
    
     function toXML()
     {
         $values=array();
         foreach ($this->collection as $item)
            $values[]=$item->toXML();
         return $values;
     }
}

