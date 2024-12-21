<?php


class PartnerPolluterModelI18nCollection extends mfObjectCollection3 {
    
    
     function toXML()
     {
         $values=array();
         foreach ($this->collection as $item)
           $values[]=$item->toXML();
         return $values;
     }
     
     function getFiles()
     {
         $items=array();
         foreach ($this->collection as $item)
         {
             if (!$item->hasFile())
                 continue;
             $items[]=$item;
         }
         return $items;
     }
}
