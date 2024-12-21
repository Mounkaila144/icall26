<?php


class DomoprimeQuotationForMeetingPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeQuotation','User'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeQuotation();   
              $item->get('creator_id',$items->hasUser()?$items->getUser():0);
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

