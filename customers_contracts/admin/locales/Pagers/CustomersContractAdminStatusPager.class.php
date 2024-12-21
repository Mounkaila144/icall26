<?php


class CustomersContractAdminStatusPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'CustomerContractAdminStatus',
           'CustomerContractAdminStatusI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getCustomerContractAdminStatus();                
              $item->setI18n($items->hasCustomerContractAdminStatusI18n()?$items->getCustomerContractAdminStatusI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

