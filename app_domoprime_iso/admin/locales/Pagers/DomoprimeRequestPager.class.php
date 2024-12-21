<?php


class DomoprimeRequestPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeCustomerRequest','Customer','CustomerContract'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeCustomerRequest();                  
              $item->get('contract_id',$items->hasCustomerContract()?$items->getCustomerContract():0);
              $item->get('customer_id',$items->getCustomer());
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

