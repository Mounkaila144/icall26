<?php


class DomoprimeSimulationForMeetingPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeSimulation','User'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeSimulation();   
              $item->get('creator_id',$items->hasUser()?$items->getUser():0);
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

