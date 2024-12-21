<?php


class DomoprimeSectorEnergyForProductPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeProductSectorEnergy',
                                 'DomoprimeEnergy','DomoprimeEnergyI18n',
                                 'DomoprimeSector',
           ));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeProductSectorEnergy();  
              $item->set('sector_id',$items->getDomoprimeSector());
              $item->set('energy_id',$items->getDomoprimeEnergy());                  
              $item->getEnergy()->setI18n($items->hasDomoprimeEnergyI18n()?$items->getDomoprimeEnergyI18n():false);
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

