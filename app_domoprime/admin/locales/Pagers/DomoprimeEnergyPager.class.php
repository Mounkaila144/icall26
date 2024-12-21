<?php


class DomoprimeEnergyPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeEnergy','DomoprimeEnergyI18n'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeEnergy();  
              $item->setI18n($items->hasDomoprimeEnergyI18n()?$items->getDomoprimeEnergyI18n():0);
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

