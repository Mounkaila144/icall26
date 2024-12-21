<?php


class DomoprimeRegionPriceForClassPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeClassRegionPrice','DomoprimeRegion'
           ));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeClassRegionPrice();  
              $item->set('region_id',$items->hasDomoprimeRegion()?$items->getDomoprimeRegion():0);  
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

