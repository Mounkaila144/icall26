<?php


class MyAddressesPager extends Pager {
    
   function __construct() {        
        parent::__construct(array("CustomerUserAddress","CustomerUser"));                
    }
    
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                 
              $item=$items->getCustomerUserAddress();   
              $item->set('user_id',$items->getCustomerUser());
              $this->items[$item->get('id')]=$item;                            
       }         
    } 
}