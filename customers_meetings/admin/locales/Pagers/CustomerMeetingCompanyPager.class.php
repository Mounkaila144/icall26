<?php


class CustomerMeetingCompanyPager extends Pager{
    
    function __construct() {
        parent::__construct(array('CustomerMeetingCompany',
                                 ));
    }
   
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                
           $item=$items->getCustomerMeetingCompany(); 
           $this->items[]=$item;               
       }          
      
    }
   
    
}
