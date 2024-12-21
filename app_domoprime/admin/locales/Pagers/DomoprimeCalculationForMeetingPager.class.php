<?php


class DomoprimeCalculationForMeetingPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeCalculation','creator'=>'User',
                                 'acceptor'=>'User',
                                 'DomoprimeZone', 'DomoprimeSector',
                                 'DomoprimeEnergy', 'DomoprimeEnergyI18n',
                                 'DomoprimeClass', 'DomoprimeClassI18n',
                                 'DomoprimeRegion'));        
        $this->setAlias(array('creator'=>'creator','acceptor'=>'acceptor')); 
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeCalculation();      
              $item->set('user_id',$items->getCreator());
              $item->set('region_id',$items->getDomoprimeRegion());
              $item->set('zone_id',$items->getDomoprimeZone());
              $item->set('sector_id',$items->getDomoprimeSector());
              $item->set('energy_id',$items->getDomoprimeEnergy());
              $item->getEnergy()->setI18n($items->hasDomoprimeEnergyI18n()?$items->getDomoprimeEnergyI18n():0);
              $item->set('class_id',$items->getDomoprimeClass());
              $item->getClass()->setI18n($items->hasDomoprimeClassI18n()?$items->getDomoprimeClassI18n():0);
              // accepted_by_id
              if ($items->hasAcceptor())
                    $item->set('accepted_by_id',$items->getAcceptor());
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

