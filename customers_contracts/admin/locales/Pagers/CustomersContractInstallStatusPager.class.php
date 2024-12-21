<?php


class CustomersContractInstallStatusPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'CustomerContractInstallStatus',
           'CustomerContractInstallStatusI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getCustomerContractInstallStatus();                
              $item->setI18n($items->hasCustomerContractInstallStatusI18n()?$items->getCustomerContractInstallStatusI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

