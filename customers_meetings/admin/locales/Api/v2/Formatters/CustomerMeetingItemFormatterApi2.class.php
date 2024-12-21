<?php

class CustomerMeetingItemFormatterApi2   extends mfFormatterFilterItemApi2  {        
   
    
    function process()
    {
      $this->data=$this->getItem()->toValues()->toArray();    
      $this->data['customer']=$this->getItem()->getCustomer()->toValues()->toArray();  
      $this->data['address']=$this->getItem()->getCustomer()->getAddress()->toValues()->toArray();  
      if ($this->getItem()->hasStatus())
            $this->data['state']=$this->getItem()->getStatus()->toArrayForTransfer();
      return $this;
    }
  
}
