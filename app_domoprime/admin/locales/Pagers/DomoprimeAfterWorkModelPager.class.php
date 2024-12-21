<?php


class DomoprimeAfterWorkModelPager extends Pager{
    
        
    function __construct()
    {             
       parent::__construct(array('DomoprimeAfterWorkModelI18n','DomoprimeAfterWorkModel'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeAfterWorkModel();                  
              $item->setI18n($items->hasDomoprimeAfterWorkModelI18n()?$items->getDomoprimeAfterWorkModelI18n():0);          
              $this->items[$item->get('id')]=$item;                            
       }      
       DomoprimeAfterWorkModelUtils::getPollutersFromPager($this);
    }
   
}
