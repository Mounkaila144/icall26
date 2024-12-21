<?php


class DomoprimeQuotationStatisticPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeQuotation','User','Customer','CustomerContract'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeQuotation();        
              $item->get('creator_id',$items->hasUser()?$items->getUser():0);
              $item->get('contract_id',$items->hasCustomerContract()?$items->getCustomerContract():0);
              $item->get('customer_id',$items->getCustomer());
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

