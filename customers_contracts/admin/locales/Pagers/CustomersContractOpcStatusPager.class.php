<?php


class CustomersContractOpcStatusPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'CustomerContractOpcStatus',
           'CustomerContractOpcStatusI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getCustomerContractOpcStatus();                
              $item->setI18n($items->hasCustomerContractOpcStatusI18n()?$items->getCustomerContractOpcStatusI18n():false);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

