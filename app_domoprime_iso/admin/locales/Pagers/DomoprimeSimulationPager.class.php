<?php


class DomoprimeSimulationPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('DomoprimeSimulation','User','Customer','CustomerContract'));               
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeSimulation();        
              $item->get('creator_id',$items->hasUser()?$items->getUser():0);
              $item->get('contract_id',$items->hasCustomerContract()?$items->getCustomerContract():0);
              $item->get('customer_id',$items->getCustomer());
              $this->items[$item->get('id')]=$item;                            
       }         
    }
   
  
}

