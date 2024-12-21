<?php


class DomoprimeBillingModelsPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeBillingModel','DomoprimeBillingModelI18n'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeBillingModel();       
              $item->setI18n($items->hasDomoprimeBillingModelI18n()?$items->getDomoprimeBillingModelI18n():0);   
              $this->items[$item->get('id')]=$item;                            
       }  
          DomoprimeBillingModelUtils::getPollutersFromPager($this);       
    }
   
  
}

