<?php


class CustomerContractZonePager extends Pager{
    
    function __construct() {
        parent::__construct(array('CustomerContractZone',
                                 ));
    }
   
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                
           $item=$items->getCustomerContractZone(); 
           $this->items[]=$item;               
       }          
      
    }
   
    
}
