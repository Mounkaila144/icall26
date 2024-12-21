<?php


class DomoprimeBillingForContractPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeBilling','User'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeBilling();  
                $item->get('creator_id',$items->hasUser()?$items->getUser():0);
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

