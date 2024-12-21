<?php


class MutualProductCommissionPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array('MutualProductCommission','MutualProduct'));            
    }        
            
    protected function fetchObjects($db)
    {              
        while ($items = $db->fetchObjects()) 
        {                       
            $item=$items->getMutualProductCommission();                  
            $item->setMutualProduct($items->hasMutualProduct()?$items->getMutualProduct():null);
            $this->items[$item->get('id')]=$item;                            
        }         
    }

}

