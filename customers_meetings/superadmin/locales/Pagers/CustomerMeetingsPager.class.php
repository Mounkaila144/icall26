<?php


class CustomerMeetingsPager extends Pager {

    
    function __construct($classes)
    {             
       parent::__construct($classes);      
       $this->setAlias(array('telepro'=>'telepro','sale'=>'sale','sale2'=>'sale2'));
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                     
              $item=$items->getCustomerMeeting(); 
              if ($items->hasCustomerMeetingStatusI18n())
                  $items->getCustomerMeetingStatus()->setCustomerMeetingStatusI18n($items->getCustomerMeetingStatusI18n());
               $item->set('telepro_id',$items->hasTelepro()?$items->getTelepro():null);              
              $item->set('sales_id',$items->hasSale()?$items->getSale():null);              
              $item->set('sale2_id',$items->hasSale2()?$items->getSale2():null);              
            //  $item->set('assistant_id',$items->hasAssistant()?$items->getAssistant():null);
              $item->set('state_id',$items->hasCustomerMeetingStatus()?$items->getCustomerMeetingStatus():null);                              
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->set('customer_id',$items->getCustomer());
              $this->items[$item->get('id')]=$item;      
       }           
        CustomerMeetingUtils::getCommentsFromPager($this);
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meetings.list.pager'));      
    }
   
    
}

