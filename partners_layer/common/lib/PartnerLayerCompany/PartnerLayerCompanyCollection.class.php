<?php

class PartnerLayerCompanyCollection extends mfObjectCollection3 {
    
     function toArrayForPdf()
     {
         $values=array();
         foreach ($this as $item)
             $values[]=$item->toArrayForDocument();    
         return $values;
     }
     
}

