<?php


class DomoprimeBillingForMeetingPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeBilling'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeBilling();                   
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

