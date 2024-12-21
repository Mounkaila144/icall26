<?php


class DomoprimeOccupationPager extends Pager {

 
    
    function __construct()
    {             
       parent::__construct(array(
           'DomoprimeOccupation',
           'DomoprimeOccupationI18n',
       ));      
      
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                                  
              $item=$items->getDomoprimeOccupation();                
              $item->setI18n($items->hasDomoprimeOccupationI18n()?$items->getDomoprimeOccupationI18n():0);              
              $this->items[$item->get('id')]=$item;                            
       }                 
    }
   
    
}

