<?php


class PartnerPolluterModelCollection extends mfObjectCollection3 {
    
    
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
             if (!$item->getI18n()->hasFile())
                 continue;
             $items[]=$item->getI18n();
         }
         return $items;
     }
}
