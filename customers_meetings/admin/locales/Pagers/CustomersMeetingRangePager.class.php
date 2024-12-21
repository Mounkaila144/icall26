<?php


class CustomersMeetingRangePager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'CustomerMeetingRange',
           'CustomerMeetingRangeI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getCustomerMeetingRange();                
              $item->setI18n($items->hasCustomerMeetingRangeI18n()?$items->getCustomerMeetingRangeI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

