<?php


class CustomerContractReferenceForSelectPager extends Pager{
    

    function __construct()
    {
        parent::__construct('CustomerContract');
    }
    
    protected function fetchObjects($db)
    {    
       $this->items=new CustomerContractCollection();
       while ($items = $db->fetchObjects()) 
       {                                
           $item=$items->getCustomerContract(); 
           $this->items[]=$item;               
       }          
      
    }
    

    
}
