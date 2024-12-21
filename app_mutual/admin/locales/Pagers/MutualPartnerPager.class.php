<?php


class MutualPartnerPager extends Pager {

    
    function __construct()
    {             
        parent::__construct(array('MutualPartner','MutualPartnerParams'));            
    }        
            
    protected function fetchObjects($db)
    {              
        while ($items = $db->fetchObjects()) 
        {                       
            $item=$items->getMutualPartner();                  
            $item->setParams($items->hasMutualPartnerParams()?$items->getMutualPartnerParams():null);
            $this->items[$item->get('id')]=$item;                            
        }         
    }
   
  
}

