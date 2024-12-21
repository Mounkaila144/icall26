<?php


class MutualMeetingCalculationPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array('MutualEngineCalculationMeeting','CustomerMeetingMutual','Customer'));        
    }        
      
    protected function fetchObjects($db)
    {              
        while ($items = $db->fetchObjects()) 
        {
            $meeting_calculation=$items->getMutualEngineCalculationMeeting();  
            $meeting = $items->getCustomerMeetingMutual();
            $meeting->setCustomer($items->getCustomer());
            $meeting_calculation->setMeeting($meeting);
            $this->items[$meeting_calculation->get('id')]=$meeting_calculation;        
        }
        MutualEngineCalculationMeeting::getMutualsAndProductsForPager($this);
    }
}
