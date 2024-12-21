<?php


class DomoprimePolluterClassPricingPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('DomoprimePolluterClassPricing','DomoprimeClass','DomoprimeClassI18n'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimePolluterClassPricing();                  
              $item->set('class_id',$items->getDomoprimeClass());           
              $item->getClass()->setI18n($items->getDomoprimeClassI18n());  
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
}
