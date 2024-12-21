<?php


class DomoprimePollutingCompanyCollection extends mfObjectCollection3 {
    
    
     function toArray()
     {
         $values=array();
         foreach ($this->collection as $item)
            $values[]=$item->toArray();
         return $values;
     }
}

