<?php


class DomoprimeSimulationModelsPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeSimulationModel','DomoprimeSimulationModelI18n'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeSimulationModel();       
              $item->setI18n($items->hasDomoprimeSimulationModelI18n()?$items->getDomoprimeSimulationModelI18n():0);   
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

