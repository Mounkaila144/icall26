<?php


class CustomersContractRangePager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'CustomerContractRange',
           'CustomerContractRangeI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getCustomerContractRange();                
              $item->setI18n($items->hasCustomerContractRangeI18n()?$items->getCustomerContractRangeI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

