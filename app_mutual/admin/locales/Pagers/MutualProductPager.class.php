<?php


class MutualProductPager extends Pager {
    
    function __construct()
    {             
        parent::__construct(array('MutualProduct','MutualPartner'));            
    }        
            
    protected function fetchObjects($db)
    {              
        while ($items = $db->fetchObjects()) 
        {                       
            $item=$items->getMutualProduct();                  
            $item->setMutualPartner($items->hasMutualPartner()?$items->getMutualPartner():null);
            $this->items[$item->get('id')]=$item;                            
        }         
    }

}

