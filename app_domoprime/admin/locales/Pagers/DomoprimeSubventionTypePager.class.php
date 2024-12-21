<?php


class DomoprimeSubventionTypePager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeSubventionType'));            
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                       
              $item=$items->getDomoprimeSubventionType();                               
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

