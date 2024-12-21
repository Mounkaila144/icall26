<?php


class DomoprimeZonePager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeZone','DomoprimeSector'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeZone();                  
              $item->set('sector_id',$items->getDomoprimeSector());
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

