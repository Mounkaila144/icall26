<?php


class DomoprimePollutingCompanyPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('DomoprimePollutingCompany'));            
    }        
            
    protected function fetchObjects($db)
    {             
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimePollutingCompany();                  
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
}
