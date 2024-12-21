<?php


class DomoprimeZonePager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeZone'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeZone();                  
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

