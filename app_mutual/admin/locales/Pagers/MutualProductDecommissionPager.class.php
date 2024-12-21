<?php


class MutualProductDecommissionPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array('MutualProductDecommission','MutualProduct'));            
    }        
            
    protected function fetchObjects($db)
    {              
        while ($items = $db->fetchObjects()) 
        {                       
            $item=$items->getMutualProductDecommission();                  
            $item->setMutualProduct($items->hasMutualProduct()?$items->getMutualProduct():null);
            $this->items[$item->get('id')]=$item;                            
        }         
    }

}

