<?php


class CustomersContractTimeStatusPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'CustomerContractTimeStatus',
           'CustomerContractTimeStatusI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getCustomerContractTimeStatus();                
              $item->setI18n($items->hasCustomerContractTimeStatusI18n()?$items->getCustomerContractTimeStatusI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

