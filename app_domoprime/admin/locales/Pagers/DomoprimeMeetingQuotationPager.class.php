<?php


class DomoprimeMeetingQuotationPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeQuotation','User','Customer','CustomerMeeting','PartnerPolluterCompany'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeQuotation();        
              $item->set('customer_id',$items->getCustomer());
              $item->set('creator_id',$items->hasUser()?$items->getUser():0);
              $item->set('meeting_id',$items->hasCustomerMeeting()?$items->getCustomerMeeting():0);
              $item->set('polluter_id',$item->hasPartnerPolluterCompany()?$item->getPartnerPolluterCompany():false);              
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

