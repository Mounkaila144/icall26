<?php


class CustomerUserForCompanyPager extends Pager {
    
   function __construct() {        
        parent::__construct("CustomerUser");                
    }
    
  /*  protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
             $item=$items->getCustomerUser();                                                                                                   
             $this->items[$item->get('id')]=$item;                         
       }         
    } */
}