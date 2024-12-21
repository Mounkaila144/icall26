<?php


class CustomerContractCompanyPager extends Pager{
    
    function __construct() {
        parent::__construct(array('CustomerContractCompany',
                                 ));
    }
   
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                
           $item=$items->getCustomerContractCompany(); 
           $this->items[$item->get('id')]=$item;               
       }          
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contracts.company.pager'));   
    }
   
    
}
