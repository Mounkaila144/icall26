<?php


class mfPhoneIndicatifCollection extends mfArray {
    
      // country | code
      function compareByCode(mfPhoneIndicatif $a,mfPhoneIndicatif $b)
      {
          if ($a->getCode()==$b->getCode())
              return 0;
          return ($a->getCode() < $b->getCode())?-1:1;
      }        
    
      function asortByCode()
      {
          uasort($this->collection,array($this,'compareByCode'));
          return $this;
      }
      
      function getCodes()
      {
          $values=new mfArray();
          foreach ($this->collection as $item)
          {    
             if (isset($values[$item->getCode()]))
                 continue;
              $values[(string)$item->getCode()]=(string)$item->getCode();
          }    
          return $values->getValues();          
      }
}
